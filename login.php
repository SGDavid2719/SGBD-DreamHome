<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome Login</title>
    <!-- OWN SCRIPTS -->
    <link rel="stylesheet" type="text/css" href="CSS/Login.css" />
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>
<body>
    <header>
        <div class="header m-4 pt-2">
            <h1>DreamHome</h1>
            <hr class="headerSplitter" />
        </div>
    </header>
    <section>
        <div class="container">
            <form>
                <div class="mt-2 mb-2">
                    <label for="eaddress">Email Address:</label><br>
                    <input type="text" id="eaddress" name="eaddress" value=""><br>
                </div>
                <div class="mt-2 mb-2">
                    <label for="password">Password:</label><br>
                    <input type="text" id="password" name="password" value="">
                </div>
                <div class="d-flex flex-row-reverse">
                    <input id="submitbutton" class="btn btn-primary mt-2" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>
    <footer>
        <div class="footer">
            &copy; 2021 David Santomé & Raixa Madueño
        </div>
    </footer>
</body>
</html>