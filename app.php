<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="github.com/jozef-javorsky-dodo, jozef.javorsky.dodo@gmail.com">
    <meta name="description" content="Cloud webie tryout.">
    <meta name="keywords" content="Symfony-cloud, Git, MySQL, PHP, JavaScript, ECMAScript, CSS, HTML">

    <title>Sudoku Grids</title>

    <link rel="icon" type="image/x-icon" href="_0fav.ico" sizes="16x16" id="html-head-link-fav">

    <script>
        String("use strict");

        try {

            setTimeout(
                () => {
                    document.querySelector(String("#html-head-link-fav"))
                        .setAttribute(
                            String("href"),
                            String("data:image/x-icon;") +
                            String("base64,") +
                            String("iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAAX") +
                            String("NSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnQA") +
                            String("ABJ0Ad5mH3gAAABNSURBVDhPnYxBCgAwCMN89969BwxRChapzN") +
                            String("BDAqJtOPdgYzqwEJ3F2gvKNGzMFfRDpwML0VmsvaBMw8ZcQT90") +
                            String("OrAQncXaC8o0bMxPzB5Uhc3hFV6GqgAAAABJRU5ErkJggg==")
                        );
                },
                Number(250)
            );

        } catch (err_f) {
            if (err_f) {
                console.clear();
                alert(String("glitchy bug"));
                console.log(err_f);
            }
        }
    </script>

    <style>
        * {
            user-select: none !important;
        }

        body {
            background-color: rgb(122, 122, 122) !important;
        }

        #html-body-header-h1 {
            margin: 6mm 0 0 13mm;
            display: inline-block;
            font-family: cursive;
            font-weight: 900;
            padding: 1mm 2mm 1mm 2mm;
            border: 1mm solid rgb(0, 0, 0);
            border-radius: 3mm;
            background-color: rgb(122, 0, 244);
            color: rgb(244, 244, 244);
            box-shadow: 0 0 3mm 3mm rgb(122, 244, 0);
        }

        table {
            margin: 1cm 0 0 3mm;
            border: 1mm solid rgb(0, 0, 0);
            border-radius: 2mm;
        }

        td {
            font-family: cursive;
            padding: 1mm 2mm 1mm 3mm;
            font-size: 4.4mm;
            font-weight: 900;
            color: rgb(244, 244, 244);
        }

        .HtmlBodyFooterBttn {
            font-family: cursive;
            font-weight: 900;
            font-size: 5mm;
            margin: 5mm 0 0 7mm;
            background-color: rgb(150, 150, 150);
            padding: 0 2mm 0 2mm;
            color: rgb(0, 0, 0);
            border-radius: 3mm;
            border: 1mm solid rgb(0, 0, 0);
        }

        .HtmlBodyFooterBttn:hover {
            cursor: pointer;
            background-color: rgb(0, 0, 0);
            color: rgb(200, 200, 200);
        }

        #html-body-footer-address-p {
            font-family: cursive;
            font-weight: 900;
            font-size: 4mm;
            color: rgb(66, 66, 66);
            margin: 7mm 0 0 11mm;
        }
    </style>
</head>


<body>


    <html-body-header>
        <h1 id="html-body-header-h1">Sudoku Grids</h1>

        <br>
    </html-body-header>


    <html-body-main>
        <?php
        try {
            $servername = "J7aLbX9pRf.g2Dh4QsL8k.com";
            $username = "github.com/jozef-javorsky-dodo";
            $password = "Y6zNpA1vWcq9sKp3vR8zE5mRg2wP9y";
            $dbname = "SudokuGrids";

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $gridId = rand(1, 7);
            $i_td = 0;

            $stmt = $conn->prepare("SELECT sudokugrid FROM SudokuGrids WHERE id = :gridId");
            $stmt->bindParam(':gridId', $gridId);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<table border='1' id='html-body-main-table'>";
                echo "<tbody>";
                for ($i_tr = 1; $i_tr <= 9; $i_tr++) {
                    echo "<tr>";
                    for ($repe = 1; $repe <= 9; $repe++) {
                        echo "<td>" . $result['sudokugrid'][$i_td] . "</td>";
                        $i_td++;
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "Sudoku grid with ID $gridId not found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        ?>
    </html-body-main>


    <html-body-footer>
        <button type="button" class="HtmlBodyFooterBttn" onclick="javascript: window.location.reload();">
            <span>Unsolved 🖱️</span>
        </button>

        <button type="button" class="HtmlBodyFooterBttn" onclick="solved_func()">👉Solved</button>

        <address>
            <p id="html-body-footer-address-p">github.com/jozef-javorsky-dodo</p>
        </address>
    </html-body-footer>


    <script>
        String("use strict");

        let solved_func = () => {

            let cells = document.querySelectorAll(String("td"));

            [...cells].forEach(c => {
                c.style.backgroundColor = String("rgb(122, 122, 122)");
                c.style.color = String("rgb(244, 244, 244)");
            });

        };

        try {

            function getRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + Number(1))) + min;
            }

            function generateRandomNumbersArray(length, min, max) {
                const randomNumbersArray = [];
                for (let i = Number(0); i < length; i++) {
                    const randomNumber = getRandomNumber(min, max);
                    randomNumbersArray.push(randomNumber);
                }
                return randomNumbersArray;
            }

            const randomNumbers = generateRandomNumbersArray(Number(9), Number(0), Number(80));

            setTimeout(
                () => {

                    let cells = document.querySelectorAll(String("td"));

                    [...randomNumbers].forEach(indx_val => {
                        cells[indx_val].style.backgroundColor = String("rgb(67, 67, 67)");
                        cells[indx_val].style.color = String("rgb(67, 67, 67)");
                    });

                },
                Number(290)
            );

        } catch (err___) {
            if (err___) {
                console.clear();
                alert(String("glitchy bug"));
                console.log(err___);
            }
        }
    </script>


</body>

</html>