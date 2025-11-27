<?php

#This project was developed by @masoudiofficial, and all the code in the visit.php file is the result of his ideas and creativity.

include_once './config.php';

function is_persian_leap_year($year) {
    $mod = $year % 33;
    return in_array($mod, [1, 5, 9, 13, 17, 22, 26, 30]);
}

$Lengthmonth = null;

function xpersiandatetime() {
    $origin = new DateTime('622-03-21 00:00:00', new DateTimeZone('Asia/Tehran'));
    $now = new DateTime('now', new DateTimeZone('Asia/Tehran'));
    $diff = $now->diff($origin);
    $persianYear = 1;
    $days = $diff->days;
    while ($days >= (is_persian_leap_year($persianYear) ? 366 : 365)) {
        $days -= is_persian_leap_year($persianYear) ? 366 : 365;
        $persianYear++;
    }
    $persianMonths = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, is_persian_leap_year($persianYear) ? 30 : 29];
    $persianMonth = 1;
    $persianDay = $days + 1;
    foreach ($persianMonths as $monthLength) {
        if ($persianDay <= $monthLength) {
            break;
        }
        $persianDay -= $monthLength;
        $persianMonth++;
    }
    global $Lengthmonth;
    $Lengthmonth = $monthLength;
    $time = $now->format('H:i:s');
    return sprintf('%04d-%02d-%02d %s', $persianYear, $persianMonth, $persianDay, $time);
}

if (isset($_POST["xstats"]) && !empty($_POST["xstats"]) && preg_match("/^[a-z]+$/", $_POST["xstats"]) && $_POST["xstats"] === "xtrue" && empty($_FILES)) {
    if (strtolower($_SERVER['HTTP_HOST']) === 'localhost' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["xreceiverstats"]) && !empty($_POST["xreceiverstats"]) && preg_match("/^[a-z0-9]+$/", $_POST["xreceiverstats"]) && strlen($_POST["xreceiverstats"]) <= 32) {

            try {

                $xpersiandatetime = xpersiandatetime();
                $xday = DateTime::createFromFormat("Y-m-d H:i:s", $xpersiandatetime)->format("d");
                $target_col = 'd' . $xday;
                $columns = ['d01', 'd02', 'd03', 'd04', 'd05', 'd06', 'd07', 'd08', 'd09', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31'];
                $index = array_search($target_col, $columns);
                $total = count($columns);

                function getPrevCols($columns, $index, $count) {
                    $result = [];
                    $total = count($columns);
                    for ($i = $count - 1; $i >= 0; $i--) {
                        $result[] = $columns[($index - $i + $total) % $total];
                    }
                    return $result;
                }

                $weekly = getPrevCols($columns, $index, 7);
                $monthly = getPrevCols($columns, $index, $Lengthmonth);
                $sum_weekly = implode(' + ', $weekly);
                $sum_monthly = implode(' + ', $monthly);

                $xselect1 = $xconnection->prepare("SELECT username, datetime, $target_col, ($sum_weekly) AS weekly, ($sum_monthly) AS monthly FROM statstable WHERE username IN (?, ?)");
                $xselect1->execute(['mainaccount', $_POST['xreceiverstats']]);
                $xselect1_r = $xselect1->fetchAll(PDO::FETCH_ASSOC);

                if ($_POST['xreceiverstats'] === 'mainaccount') {
                    $xselect1_r[] = $xselect1_r[0];
                } else {
                    $xmap = [];
                    foreach ($xselect1_r as $xrow) {
                        $xmap[$xrow['username']] = $xrow;
                    }
                    $xselect1_r = [$xmap['mainaccount'], $xmap[$_POST['xreceiverstats']]];
                }

                if (DateTime::createFromFormat("Y-m-d H:i:s", $xselect1_r[1]['datetime'])->format("d") === $xday) {

                    $xupdate1 = $xconnection->prepare("UPDATE statstable SET d" . $xday . "=d" . $xday . "+1 WHERE username IN (?, ?)");
                    $xupdate1->execute(['mainaccount', $_POST['xreceiverstats']]);

                    echo json_encode(array("xdaily" => ($xselect1_r[1][$target_col] + 1), "xweekly" => ($xselect1_r[1]['weekly'] + 1), "xmonthly" => ($xselect1_r[1]['monthly'] + 1)));
                } else {

                    if (DateTime::createFromFormat("Y-m-d H:i:s", $xselect1_r[0]['datetime'])->format("d") !== $xday) {

                        $xupdate2 = $xconnection->prepare("UPDATE statstable SET datetime=?, d" . $xday . "=1 WHERE username IN (?, ?)");
                        $xupdate2->execute([$xpersiandatetime, 'mainaccount', $_POST['xreceiverstats']]);
                    } else {

                        $xupdate3 = $xconnection->prepare("UPDATE statstable SET datetime=?, d" . $xday . "=1 WHERE username=?");
                        $xupdate3->execute([$xpersiandatetime, $_POST['xreceiverstats']]);

                        $xupdate4 = $xconnection->prepare("UPDATE statstable SET d" . $xday . "=d" . $xday . "+1 WHERE username=?");
                        $xupdate4->execute(['mainaccount']);
                    }

                    echo json_encode(array("xdaily" => 1, "xweekly" => ($xselect1_r[1]['weekly'] - $xselect1_r[1][$target_col] + 1), "xmonthly" => ($xselect1_r[1]['monthly'] - $xselect1_r[1][$target_col] + 1)));
                }
            } catch (Throwable $e) {
                echo json_encode(array("xdaily" => 0, "xweekly" => 0, "xmonthly" => 0));
            } finally {
                $xconnection = null;
            }
        }
    }
}
?>
