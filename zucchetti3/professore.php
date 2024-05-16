<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="studente.css">
</head>

<body>
    <div class="todo">
        <?php
        include("funzioniPHP/connection.php");
        include("funzioniPHP/metodiPHP.php");

        $surname = surnameUser();
        $name = nameUser();
        $classData = classUser();

        $surname = strtoupper($surname);
        $name = strtoupper($name);

        ?>
        <div class="sidebar">
            <div class="icon_stud">
                <div class="icona">
                    <img src="assets/UserAvatar.png" alt="account settings">
                </div>
                <div class="name_stud">
                    <?php echo "<h3>" . $surname . " " . $name . "</h3>" ?>
                    <?php echo "<h4>" . $classData['anno'] . " " . $classData['sezione'] . " ISTITUTO X" . "</h4>" ?>
                </div>
            </div>

            <div class="sezioni" id="sezioni">

                <div class="sez sez1">
                    <h3>HOME</h3>
                    <p>></p>

                    <div class="ora home">
                        <h3 type="button" class="com">COMUNICAZIONI</h3>
                        <h3 type="button" class="or">ORARI</h3>
                        <h3 type="button" class="prof">PROFESSORI</h3>
                        <h3 type="button" class="pc">PCTO</h3>
                    </div>
                </div>

                <div class="sez sez2">
                    <button class="gradeButton" type="button" value="9" onclick="slectSubj(9); avgAjax(9);">CLASSI</button>

                    <p>></p>

                    <div id="vote" class="specifiche vote">
                        <button type="button" value="1" onclick="slectSubj(1); avgAjax(1);">5IB</button>
                        <button type="button" value="1" onclick="slectSubj(2); avgAjax(2);">5IC</button>
                        <button type="button" value="2" onclick="slectSubj(3); avgAjax(3);">5ID</button>
                    </div>
            </div>

        </div>

        <div id="gradesDisplay" class=" voti">
            <script>
                function slectSubj(subject) {

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                                document.getElementById('gradesDisplay').innerHTML = xhr.responseText;
                            } else {
                                console.error('Request failed with status:', xhr.status);
                            }
                        }
                    };
                    xhr.open('POST', 'funzioniPHP/metodiPHP.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('class=' + subject + '&method=' + 'gradesUser');
                }
            </script>

            <label for="class">CLASSE: </label>

            <select name="a" id="a">
                <?php
                $sql = "SELECT classe.sezione, classe.ID FROM classe";
                $x = $conn->query($sql);

                while ($ciao = $x->fetch_assoc()){
                    echo "<option value=" . $ciao['sezione'] . ">" . $ciao['sezione'] . "</option>";
                }
                ?>
            </select>
            <label for="stud">STUDENTE: </label>
            <select name="a" id="a">
                <?php
                $sql = "SELECT studente.cognome FROM studente WHERE studente.classe_ID = 1";
                $x = $conn->query($sql);

                while ($ciao2 = $x->fetch_assoc()){
                    echo "<option value=" . $ciao2['cognome'] . ">" . $ciao2['cognome'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".sez1 p").on("click", function() {
                $(".sez1 p").toggleClass("gira");
                $(".sez1").toggleClass("aumenta");
            });
        });
        $(document).ready(function() {
            $(".sez2 p").on("click", function() {
                $(".sez2 p").toggleClass("gira");
                $(".sez2").toggleClass("aumenta");
            });
        });
        $(document).ready(function() {
            $(".sez2 p").on("click", function() {
                $(".vote").toggleClass("specifiche");
            });
        });

        $(document).ready(function() {
            $(".sez1 p").on("click", function() {
                $(".home").toggleClass("ora");
            });
        });
        $(document).ready(function() {
            $(".or").on("click", function() {
                $(".orari").removeClass("out");
            });
        });
        $(document).ready(function() {
            $(".sez1 p").on("click", function() {
                $(".orari").addClass("out");
            });
        });

        $(document).ready(function() {
            $(".gen").on("click", function() {
                $(".voti").removeClass("out");
            });
        });
        $(document).ready(function() {
            $(".sez2 p").on("click", function() {
                $(".voti").addClass("out");
            });
        });
        $(document).ready(function() {
            $(".gen").on("click", function() {
                $(".votiMedi").removeClass("out");
                $(".mediavoti").removeClass("out");
            });
        });

        $(document).ready(function() {
            $(".sez2 p").on("click", function() {
                $(".votiMedi").addClass("out");
            });
        });
        
    </script>

</body>

</html>