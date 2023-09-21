<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".//assets/css/product-list.css" type="text/css">
    <link rel="stylesheet" href=".//assets/css/footer.css" type="text/css">
    <link rel="stylesheet" href=".//assets/css/header.css" type="text/css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap&amp;_cacheOverride=1679484892371"
        data-tag="font">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        data-tag="font">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>
</head>

<body>
    <div id="bar-header">
        <?php
        include(".//components/header.php");
        ?>
    </div>
    <div class="wrapper">
        <?php
        if (isset($_GET['search']) && $_GET['search'] > 0) {
            include(".//mainproduct/paging-search.php");
        } else {
            include(".//mainproduct/searching.php");
            include(".//mainproduct/menu.php");
            if (isset($_GET['idBrand']) && ($_GET['idBrand'] > 0)) {
                include(".//mainproduct/paging-brand.php");
            } else {
                if (isset($_GET['from']) && isset($_GET['to']) > 0) {
                    include(".//mainproduct/paging-price.php");
                } else {
                    if (isset($_GET['color']) && isset($_GET['color']) > 0) {
                        include(".//mainproduct/paging-color.php");
                    } else {
                        if (isset($_GET['gender']) && isset($_GET['gender']) > 0) {
                            include(".//mainproduct/paging-gender.php");
                        } else {
                            if (isset($_GET['model']) && isset($_GET['model']) > 0) {
                                include(".//mainproduct/paging-model.php");
                            } else {
                                if (isset($_GET['nang-cao']) && isset($_GET['nang-cao']) > 0) {
                                    include(".//mainproduct/search-advanced.php");
                                } else {
                                    include("mainproduct/main.php");
                                }
                            }
                        }
                    }
                }
            }

        }




        ?>
    </div>
    <div id="my-footer">
        <?php
        include(".//components/footer.php");
        ?>
    </div>
    </div>

</body>
  <!--start Hiện thanh line-->
  <script>
    var lineProduct = document.getElementById("navbarProduct");

    lineProduct.style.borderBottom = '2px solid #fff';
    lineProduct.style.paddingBottom = '1.15px';
  </script>
  <!--end Hiện thanh line-->
</html>
