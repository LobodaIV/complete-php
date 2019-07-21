<?php

echo '<table border="1">';

for ($i = 1; $i <= 10; $i++) {
    echo "<tr>";
    for ($j = 2; $j <= 10; $j++) {
        if ($i % 2 == 0 and $j % 2 == 0) {
            echo "<td>${j} x ${i} = (" . $j * $i . ")</td>";
        } elseif ($i % 2 != 0 and $j % 2 != 0) {
            echo "<td>${j} x ${i} = [" . $j * $i . "]</td>";

        } else {
            echo "<td>${j} x ${i} = " . $j * $i . "</td>";
        }

    }
    echo "</tr>";
}
echo '</table>';
