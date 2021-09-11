<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <title></title>
        <style>
            #email {width: 200px;}
            td {width:130px; outline:solid black 2px; margin:0px;}
            td:last-child {width:auto; outline:solid black 2px; margin:0px;}

        </style>
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
            function dodawanie($imie, $nazwisko, $email, $placa_netto)
            {
                $conn = laczenie();
                $sql = 'INSERT INTO `dane_pracownikow` (`imie`, `nazwisko`, `email`, `data_dolaczenia`, `id`, `placa_netto`) VALUES ("'.$imie.'","'.$nazwisko.'","'.$email.'", "'.date("Y-m-d").'", NULL , "'.$placa_netto.'");';
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
                    $pracownicy[$row[4]] = new Pracownik($row[4],$row[0],$row[1],$row[2],$row[3],$row[5]);
                }
            }
            


            // Class for pracownik
            class Pracownik
            {
                public $id;
                public $imie;
                public $nazwisko;
                public $email;
                public $data_dolaczenia;
                public $placa_brutto;
                public $placa_netto;
                public $ile_pracuje;

                public static $podatek = 0.23;

                public function make_td()
                {
                    echo "
                    <form method='GET' action='index.php'>
                    <tr>
                    <td>" . $this->imie . "</td>
                    <td>" . $this->nazwisko . "</td>
                    <td id='email'>" . $this->email . "</td>
                    <td>" . $this->data_dolaczenia . "</td>
                    <td>" . $this->placa_netto . "zł</td>
                    <td>" . $this->placa_brutto . "zł</td>
                    <td>" . $this->ile_pracuje. ' dni</td>
                    <td><input value="usuń pracownika" type="submit" name="'.$this->id.'"></td>
                    </form>
                    </tr>';
                }

                public function delete_from_database()
                {
                    if(isset($_GET[$this->id]))
                    {
                        $conn = laczenie();
                        $sql = 'DELETE FROM `dane_pracownikow` WHERE `dane_pracownikow`.`id` ='.$this->id;
                        if($result = mysqli_query($conn, $sql))
                        {
                            echo "Usunięto pracownika ".$this->imie." ".$this->nazwisko;
                        }
                        else
                        {
                            echo "Błąd: ".mysqli_error($conn);
                        }
                        header("location:index.php");
                    }
                }

                public function __construct($id, $imie, $nazwisko, $email, $data_dolaczenia, $placa_netto)
                {
                    $this->id = $id;
                    $this->imie = $imie;
                    $this->nazwisko = $nazwisko;
                    $this->email = $email;
                    $this->data_dolaczenia = $data_dolaczenia;
                    $this->placa_netto = $placa_netto;
                    $this->placa_brutto = $placa_netto + ($placa_netto * self::$podatek);
                    $this->ile_pracuje = round((strtotime(date("Y-m-d")) - strtotime($data_dolaczenia)) / 86400);
                    
                }
            }


        ?>
    </head>
    <body>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>imie</th>
                        <th>nazwisko</th>
                        <th>email</th>
                        <th>data dołączenia</th>
                        <th>płaca netto</th>
                        <th>płaca brutto</th>
                        <th>ilość dni pracy</th>
                    </tr>
                </thead>
                <?php
                    
                    $koszty = 0;
                    foreach($pracownicy as $pracownik)
                    {
                        $pracownik->make_td();
                        $pracownik->delete_from_database();
                        $koszty += $pracownik->placa_brutto;
                    }
                    echo "<tr><th></th><th></th><th></th><th></th><th></th><th>Suma: ".$koszty."zł</th></tr>";
                ?>
            </table>
        </div>
        <div>
            <br>
            <form method="POST" action="index.php">
                <input name="imie" type="text">
                <input name="nazwisko" type="text">
                <input name="email" type="text">
                <input name="placa_netto" type="number">
                <input name="dodaj" type="submit" value="dodaj nowego pracownika">
            </form>
            <?php
                if(isset($_POST["imie"]) && isset($_POST["nazwisko"]) && isset($_POST["email"]) && isset($_POST["placa_netto"]) && isset($_POST["dodaj"]))
                {
                    $czy_wykonac = true;

                    if($_POST["imie"] == "")
                    {
                        echo "brak imienia<br>";
                        $czy_wykonac = false;
                    }
                    if($_POST["nazwisko"] == "")
                    {
                        echo "brak nazwiska<br>";
                        $czy_wykonac = false;
                    }
                    if($_POST["email"] == "")
                    {
                        echo "brak emaila<br>";
                        $czy_wykonac = false;
                    }
                    elseif(!strpos($_POST["email"],"@"))
                    {
                        echo "nieprawidłowy format emaila<br>";
                        $czy_wykonac = false;
                    }
                    if($_POST["placa_netto"] == "")
                    {
                        echo "brak płacy netto<br>";
                        $czy_wykonac = false;
                    }
                
                    if($czy_wykonac)
                    {
                        dodawanie($_POST["imie"], $_POST["nazwisko"], $_POST["email"],$_POST["placa_netto"]);
                        header("location:index.php");
                    }
                }
            ?>
        </div>
    </body>
</html>