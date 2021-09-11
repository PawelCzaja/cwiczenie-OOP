<html>
    <head>
        <title></title>
        <?php

            $pracownicy = [];

            // funkcja laczaca z baza zwracajaca conn
            function laczenie()
            {
                // Conection data
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "pracownicy";


                $conn = mysqli_connect($servername, $username, $password, $database);
                if (mysqli_connect_errno()) 
                {
                  die("Connection failed: " . mysqli_connect_error());
                }
                else
                {
                    echo "Connected successfully<br>";
                }
                return $conn;
            }

            // fukncja dodajaca pracownikow
            function dodawanie($imie, $nazwisko, $email, $data_dolaczenia)
            {
                $conn = laczenie();
                $sql = 'INSERT INTO `dane_pracownikow` (`imie`, `nazwisko`, `email`, `data_dolaczenia`, `id`) VALUES ("'.$imie.'","'.$nazwisko.'","'.$email.'", "'.$data_dolaczenia.'", NULL);';
                if(mysqli_query($conn, $sql))
                {
                    echo "Dodano nowego pracownika: ".$imie." ".$nazwisko;
                }
                else
                {
                    echo "blad dodawania ".mysqli_error($conn);
                }
            }


            // wyswietlanie wszystkich pracownikow
            
            $conn = laczenie();
            $sql = 'SELECT * FROM dane_pracownikow';
            if ($result = mysqli_query($conn, $sql))
            {
                while ($row = mysqli_fetch_row($result))
                {
                    $pracownicy[$row[4]] = new Pracownik($row[4],$row[0],$row[1],$row[2],$row[3]);
                }
            }
            


            // Class for pracownik
            class Pracownik
            {
                public $imie;
                public $nazwisko;
                public $email;
                public $data_dolaczenia;

                public function make_td()
                {
                    echo "<tr>
                    <td>" . $this->imie . "</td>
                    <td>" . $this->nazwisko . "</td>
                    <td>" . $this->email . "</td>
                    <td>" . $this->data_dolaczenia . "</td>
                    </tr>";
                }

                public function __construct($id, $imie, $nazwisko, $email, $data_dolaczenia)
                {
                    $this->id = $id;
                    $this->imie = $imie;
                    $this->nazwisko = $nazwisko;
                    $this->email = $email;
                    $this->data_dolaczenia = $data_dolaczenia;
                    
                }
            }


        ?>
    </head>
    <body>
        <table>
            <?php
                
                foreach($pracownicy as $pracownik)
                {
                    $pracownik->make_td();
                }
            ?>
        </table>
    </body>
</html>