<aside id="right">


    <div class="loginpalikka">
        <!-- Button to open the modal login form -->
        <?php
        if (isset($userEtunimi)) {
            echo '<a class="button" href="logout.php">Kirjaudu ulos</a>';
        } else{
            echo '<a id="loginNappi" class="button"  href="login.php">Kirjaudu sisään</a>';
        }
        ?>
        <!--<button onclick="document.getElementById('login').style.display='block';">Kirjaudu sisään</button>-->

        <!-- The Modal -->
        <div id="login" class="hidden">
            <span class="close" title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="login.php" method="post">
                <div class="imgcontainer">
                    <img src="img/hammer.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">

                    <label><b>Sähköpostiosoite</b></label>
                    <input type="text" placeholder="Sähköpostiosoite" name="sahkoposti" required>

                    <label><b>Salasana</b></label>
                    <input type="password" placeholder="Salasana" name="pwd" required>

                    <button class="button" type="submit">Kirjaudu sisään!</button>
                    <input type="checkbox" checked="checked"> Muista minut
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <span class="pwd">Unohditko <a href="">salasanasi?</a></span>
                </div>
            </form>
        </div>

        <!-- Button to open the modal login form -->
        <button class="button" id="registerNappi">Rekisteröidy tästä!</button>

        <!-- The Modal -->
        <div id="register" class="hidden">
            <span class="close" title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="confirm.php" method="post">
                <div class="imgcontainer">
                    <img src="img/hammer.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <label><b>Etunimi</b></label>
                    <input type="text" placeholder="Etunimi" name="data[etunimi]" required>

                    <label><b>Sukunimi</b></label>
                    <input type="text" placeholder="Sukunimi" name="data[sukunimi]" required>

                    <!--<label><b>Sijainti</b></label>
                    <input type="text" placeholder="Sijainti" name="data[sijainti]" required>-->

                    <label><b>Maakunta</b></label>
                    <div type="kunta">
                        <?php


                        $query = $DBH->query("SELECT * FROM Sijainti"); // Run your query

                        echo '<select id="kunta" name="data[sijainti]">'; // Open your drop down box

                        // Loop through the query results, outputing the options one by one
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['SijaintiID'] . '">' . $row['Maakunta'] . '</option>';
                        }

                        echo '</select>';// Close your drop down box
                        ?>
                    </div>

                    <label><b>Sähköposti</b></label>
                    <input type="email" placeholder="Sähköposti" name="data[sähköposti]" required>

                    <label><b>Salasana</b></label>
                    <input type="password" placeholder="Salasana" name="data[pwd]" required>

                    <button class="button" type="submit">Rekisteröidy</button>

            </form>
        </div>
    </div>
    <div class="hakupalikka">
        <form id="haku" action="haku.php" method="post"><input type="text" placeholder="Hae tästä..."
                                                               name="avainsana">
            <button class="button" type="submit" value="Search">Hae</button>
        </form>
    </div>

</aside>