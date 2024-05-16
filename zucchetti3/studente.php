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
                    <button class="gradeButton" type="button" value="9" onclick="slectSubj(9); avgAjax(9);">VOTI</button>

                    <p>></p>

                    <div id="vote" class="specifiche vote">
                        <button type="button" value="1" onclick="slectSubj(1); avgAjax(1);">ITALIANO</button>
                        <button type="button" value="1" onclick="slectSubj(2); avgAjax(2);">STORIA</button>
                        <button type="button" value="2" onclick="slectSubj(3); avgAjax(3);">MATEMATICA</button>
                        <button type="button" value="3" onclick="slectSubj(4); avgAjax(4);">INFORMATICA</button>
                        <button type="button" value="3" onclick="slectSubj(5); avgAjax(5);">SISTEMI E RETI</button>
                    </div>

                </div>
                <div class="sez">
                    <h3 class="ass">ASSENZE</h3>
                </div>
                <div class="sez">
                    <h3>AGENDA</h3>
                </div>
            </div>

        </div>

        <div id="gradesDisplay" class="out voti">
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
                    xhr.send('subject=' + subject + '&method=' + 'gradesUser');
                }

                function avgAjax(subject) {

                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                                document.getElementById('votiMedi').innerHTML = xhr.responseText;
                            } else {
                                console.error('Request failed with status:', xhr.status);
                            }
                        }
                    };
                    xhr.open('POST', 'funzioniPHP/metodiPHP.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('subject=' + subject + '&method=' + 'averageGrade');
                }
            </script>
        </div>
    </div>

    <div class="votiMedi out">
        <div class="mediavoti out">
            <div class="titlemedia">
                <h3>MEDIA GENERALE</h3>
            </div>
            <div class="numeromedia">
                <p class="medianum" id="votiMedi">X</p>
            </div>
        </div>
    </div>
    </div>

    <div class="out comunicazioni ">
        <div class="titleCom">COMUNICAZIONI RECENTI</div>
        <table class="tabellaComunicazioni">
            <tr>
                <td>Verifica di Italiano il gg/mm/aa</td>
            </tr>
            <tr>
                <td>Verifica di Storia il gg/mm/aa</td>
            </tr>
            <tr>
                <td>Verifica di Matematica il gg/mm/aa</td>
            </tr>
        </table>
    </div>

    <!-- 
    <div class="out orari">
        <div class="titleOrari">ORARIO</div>
        <table class="tabellaOrari white">
            <tr class="week-days">
                <th></th>
                <th>Lunedì</th>
                <th>Martedì</th>
                <th>Mercoledì</th>
                <th>Giovedì</th>
                <th>Venerdì</th>
                <th>Sabato</th>
            </tr>
            <tr class="white">
                <td>8:00 - 9:00</td>
                <td>Matematica</td>
                <td>Storia</td>
                <td>Scienze</td>
                <td>Lingua</td>
                <td>Arte</td>
                <td>Sport</td>
            </tr>
            <tr class="white">
                <td>9:00 - 10:00</td>
                <td>Italiano</td>
                <td>Matematica</td>
                <td>Lingua</td>
                <td>Scienze</td>
                <td>Storia</td>
                <td>Arte</td>
            </tr>
            <tr class="white">
                <td>10:00 - 10:50</td>
                <td>Italiano</td>
                <td>Matematica</td>
                <td>Lingua</td>
                <td>Scienze</td>
                <td>Storia</td>
                <td>Arte</td>
            </tr>
            <tr class="white">
                <td>10:50 - 11:05</td>
                <td>Italiano</td>
                <td>Matematica</td>
                <td>Lingua</td>
                <td>Scienze</td>
                <td>Storia</td>
                <td>Arte</td>
            </tr>
            <tr class="white">
                <td>11:05 - 12:05</td>
                <td>Italiano</td>
                <td>Matematica</td>
                <td>Lingua</td>
                <td>Scienze</td>
                <td>Storia</td>
                <td>Arte</td>
            </tr>
            <tr class="white">
                <td>12:05 - 13:05</td>
                <td>Italiano</td>
                <td>Matematica</td>
                <td>Lingua</td>
                <td>Scienze</td>
                <td>Storia</td>
                <td>Arte</td>
            </tr>
        </table>
    </div>

    <div class="out professori">
        <div class="titleProf">PROFESSORI</div>
        <table class="tabellaProfessori white">
            <tr class="white">
                <th>Nome</th>
                <th>Cognome</th>
                <th>Materia</th>
                <th>Email</th>
            </tr>
            <tr class="white">
                <td>Mario</td>
                <td>Rossi</td>
                <td>Matematica</td>
                <td>mario.rossi@example.com</td>
            </tr>
            <tr class="white">
                <td>Anna</td>
                <td>Bianchi</td>
                <td>Italiano</td>
                <td>anna.bianchi@example.com</td>
            </tr>
            <tr class="white">
                <td>Luca</td>
                <td>Verdi</td>
                <td>Scienze</td>
                <td>luca.verdi@example.com</td>
            </tr>
            <tr class="white">
                <td>Luca</td>
                <td>Verdi</td>
                <td>Scienze</td>
                <td>luca.verdi@example.com</td>
            </tr>
            <tr class="white">
                <td>Luca</td>
                <td>Verdi</td>
                <td>Scienze</td>
                <td>luca.verdi@example.com</td>
            </tr>
            <tr class="white">
                <td>Luca</td>
                <td>Verdi</td>
                <td>Scienze</td>
                <td>luca.verdi@example.com</td>
            </tr>
            <tr class="white">
                <td>Luca</td>
                <td>Verdi</td>
                <td>Scienze</td>
                <td>luca.verdi@example.com</td>
            </tr>
            <tr class="white">
                <td>Luca</td>
                <td>Verdi</td>
                <td>Scienze</td>
                <td>luca.verdi@example.com</td>
            </tr>
        </table>
    </div>


    <div class="pcto">
        <p>Non sono presenti novità nel registro elettronico, per le <br> <br> attività di PCTO.</p>
    </div>

    <div class="out assenze">
        <div class="titleAss">ASSENZE</div>
        <table class="tabellaAssenze white">
            <tr class="white">
                <th>Nome</th>
                <th>Cognome</th>
                <th>Motivo</th>
            </tr>
            <tr class="white">
                <td>Mario</td>
                <td>Rossi</td>
                <td>DASASD</td>
            </tr>
            <tr class="white">
                <td>Anna</td>
                <td>Bianchi</td>
                <td>DASASD</td>
            </tr>
            <tr class="white">
                <td>Anna</td>
                <td>Bianchi</td>
                <td>DASASD</td>
            </tr>
            <tr class="white">
                <td>Anna</td>
                <td>Bianchi</td>
                <td>DASASD</td>
            </tr>
            <tr class="white">
                <td>Anna</td>
                <td>Bianchi</td>
                <td>DASASD</td>
            </tr>
            <tr class="white">
                <td>Anna</td>
                <td>Bianchi</td>
                <td>DASASD</td>
            </tr>
        </table>
    </div>
    -->

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
        /*
        $(document).ready(function() {
            $(".sez3 p").on("click", function() {
                $(".sez3 p").toggleClass("gira");
                $(".sez3").toggleClass("aumenta");
            });
        });
        */
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
        /*
        $(document).ready(function() {
            $(".com").on("click", function() {
                $(".comunicazioni").removeClass("out");
            });
        });
        $(document).ready(function() {
            $(".sez1 p").on("click", function() {
                $(".comunicazioni").addClass("out");
            });
        });
        $(document).ready(function() {
            $(".prof").on("click", function() {
                $(".professori").removeClass("out");
            });
        });
        $(document).ready(function() {
            $(".sez1 p").on("click", function() {
                $(".professori").addClass("out");
            });
        });
        $(document).ready(function() {
            $(".pc").on("click", function() {
                $(".pcto").addClass("change");
            });
        });
        $(document).ready(function() {
            $(".sez1 p").on("click", function() {
                $(".pcto").removeClass("change");
            });
        });
        $(document).ready(function() {
            $(".ass").on("click", function() {
                $(".assenze").toggleClass("out");
            });
        });
        */
    </script>

</body>

</html>