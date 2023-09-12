<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    .box {
        position: relative;
        display: inline-block;
        border-radius: 0px 8px 8px 0px;
        overflow: hidden;
        width: 200px; /* Atur lebar sesuai kebutuhan */
        height: 30px; /* Atur tinggi sesuai kebutuhan */
        padding: 7px;
        color: white;
        text-align: center;
        background: #0D86FF;
    }

    .hid-box {
        position: absolute;
        top: 0;
        right: 100%;
        transition: all .3s ease-out;
        height: 100%;
        width: 100%; /* Sesuaikan dengan tinggi dan lebar .box */
        background: orangered;
        border-radius: 1px;
    }

    .box:hover .hid-box {
        right: 0;
    }
    </style>
</head>

<body>
    <div class="box">
        <div class="hid-box">
        </div>
        Teks dalam box
    </div>
</body>

</html>
