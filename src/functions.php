<?php

function task1($arr, $flag = false)
{
    if ($flag) {
        return implode("", $arr);
    } else {
        for ($i = 0; $i < sizeof($arr); $i++) {
            echo "<p>" . $arr[$i] . "</p>";
        }
    }
}

function task2($act, ...$numbers)
{
    if (count($numbers) > 1) {
        switch ($act) {
            case '+':
                $result = 0;
                foreach ($numbers as $num) {
                    $result += $num;
                }
                return $result;
                break;
            case '-':
                $n = $numbers[0];
                for ($i = 0; $i < count($numbers); $i++) {
                    $n -= $numbers[$i+1];
                }
                return $n;
                break;
            case '/':
                $n = $numbers[0];
                for ($i = 0; $i < count($numbers); $i++) {
                    if (isset($numbers[$i+1])) {
                        $n = $n / $numbers[$i+1];
                    }
                }
                return $n;
                break;
            case '*':
                $n = $numbers[0];
                for ($i = 0; $i < count($numbers); $i++) {
                    if (isset($numbers[$i+1])) {
                        $n = $n * $numbers[$i+1];
                    }
                }
                return $n;
                break;
            default:
                echo "The action does not exist";
                break;
        }

    } else {
        return $numbers[0];
    }
}

function task3($start, $end)
{
    echo '<table border="1">';

    for ($i = 1; $i <= $start; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $end; $j++) {
            echo "<td>${j} x ${i} = " . $j * $i . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';

}

function task4()
{
    echo date('d.m.Y H:i');
}

function task5($str)
{
    if (($timestamp = strtotime($str)) === false) {
        echo "Строка ($str) недопустима";
    } else {
        echo $timestamp;
    }
}

function task6($str)
{
    echo str_replace("К", "", $str);
}

function task7($str)
{
    echo str_replace("Две", "Три", $str);
}

function task8($file)
{
    $content = "";
    if (file_exists($file)) {
        $f = fopen($file, "rb");
        $content = fread($f, filesize(($file)));
        fclose($f);
    } else {
         echo "File does not exist!";
    }

    echo $content;

}