<?php

function task1($file)
{
    $fileData = file_get_contents($file);
    try {
        $xml = new SimpleXMLElement($fileData);
    } catch(Exception $e) {
        echo $e->getMessage();
    }

    echo "<p>Purchase Order Number: " . $xml->attributes()->PurchaseOrderNumber . "</p><hr>";
    foreach ($xml->Address as $item) {
        echo "Address Type: " . $item->attributes()->Type->__toString() . "<br>";
        echo "Customer Name: " . $item->Name . "<br>";
        echo "Street: " . $item->Street . "<br>";
        echo "City: " . $item->City . "<br>";
        echo "State: " . $item->State . "<br>";
        echo "ZIP Code: " . $item->Zip . "<br>";
        echo "Country: " . $item->Country . "<br>";
        echo "<hr>";
    }
    echo "<p>Delivery Notes: <b>" . $xml->DeliveryNotes->__toString() . "</b></p><hr>";

    foreach ($xml->Items->Item as $item) {
        echo "Part Number: " . $item->attributes()->PartNumber->__toString() . "<br>";
        echo "Product Name: " . $item->ProductName->__toString() . "<br>";
        echo "Quantity: " . $item->Quantity->__toString() . "<br>";
        echo "Price: " . $item->USPrice->__toString() . "<br>";
        echo "Comment: " . $item->Comment->__toString() . "<br>";
        echo "Ship Date: " . $item->ShipDate . "</br><hr>";
    }

}

function task2()
{
    $staffs = [
        "Andy" => [
            "age" => 25,
            "sex" => "Male",
            "occupation" => "BlackSmith",
        ],
        "Barbara" => [
            "age" => 30,
            "sex" => "Female",
            "occupation" => "Attorney",
        ],
        "John" => [
            "age" => 45,
            "sex" => "Male",
            "occupation" => "Carpenter",
        ],
        "Smith" => [
            "age" => 50,
            "sex" => "Male",
            "occupation" => "Truck-Driver",
        ],
        "Emmy" => [
            "age" => 30,
            "sex" => "Female",
            "occupation" => "Software Developer",
        ],
    ];

    if(!file_exists("output.json")) {
        file_put_contents("output.json", json_encode($staffs));
    }

    if ( rand(1,10) > 5) {
        $staffs = json_decode(file_get_contents("output.json"),1);
        $staffs["NewStaff"] = [
          "age" => 20,
          "sex" => "Male",
          "occupation" => "Loader",
        ];
        if(!file_exists("output2.json")) {
            file_put_contents("output2.json", json_encode($staffs));
        }
    }

    if (file_exists("output.json") and file_exists("output2.json")) {
        var_dump(array_diff_assoc(
            json_decode(file_get_contents("output2.json"),1),
            json_decode(file_get_contents("output.json"),1)
        ));
    }
}

function task3()
{
    $numbers = null;
    $evenSum = null;

    for ($i = 0; $i <= 50; $i++) {
        $numbers[] = rand(1,100);
    }

    if(($f = fopen("numbers.csv","w")) !== false) {
        fputcsv($f, $numbers, ";");
        fclose($f);
    } else {
        echo "Can't open the file numbers.csv";
    }

    if (($f = fopen("numbers.csv", "r")) !== false) {
        while (($numbers = fgetcsv($f, 1000,";")) !== false) {
            echo "Numbers we have read: " ;
            foreach ($numbers as $number) {
               echo "${number} ";
               if ($number % 2 == 0) {
                   $evenSum += $number;
               }
            }
            echo "<p>Even numbers sum: " . "${evenSum}</p>";
        }
    }
}

function task4()
{
    $ch = curl_init();
    curl_setopt_array(
      $ch,
      [
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_URL => "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json",
          CURLOPT_HTTPHEADER => [
              "Content-Type: application/json",
              "cache-control: no-cache"
          ]
      ]
    );

    $response = json_decode(curl_exec($ch),1);

    if (curl_error($ch)) {
        curl_close($ch);
        echo "cURL Error :" . curl_error($ch);
    }

    echo "Page Id: " . $response["query"]["pages"]["15580374"]["pageid"];
    echo "Title: " . $response["query"]["pages"]["15580374"]["title"];
}