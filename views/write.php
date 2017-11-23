<?php
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
unset($_SESSION['errorMessage']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Instagram</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <span id="tSpan">
        <section id="tSection">
            <nav>
                <div id="logoImg"><a href="main.php"><img class="topLogo1" src="images/instaLogo2.jpg"></a></div>
                <div><input type="text" name="search" placeholder="검색"></div>
                <div id="miniImg">
                    <div></div>
                    <div><a href="write.php"><img class="topLogo2" src="images/insta0.jpg"></a></div>
                    <div><a href=""><img class="topLogo2" src="images/insta1.jpg"></a></div>
                    <div><a href=""><img class="topLogo2" src="images/insta2.jpg"></a></div>
                    <div><a href="/profile.php?nickname=<?=htmlspecialchars($_SESSION['nickname']);?>"><img class="topLogo2" src="images/insta3.jpg"></a></div>
                </div>
            </nav>
            <main>
                <div class="writeFrame">
                    <form class="formFrame" action="write_process.php" method="post" enctype="multipart/form-data">
                        <div class="form0">새로운 글 작성</div>
                        <div class="form1">
                            <input class="selectimg" type="file" name="fileToUpload">
                        </div>
                        <div class="form2">
                            <input class="content" type="text" name="content" placeholder="내용을 입력하세요"></input>
                        </div>
                        <div class="form3">
                            <input class="yes" type="submit" name="yes" value="등록">
                            <input class="no" type="submit" name="no" value="취소">
                        </div>
                        <?php if ($errorMessage): ?>
                            <div class="errorMessage"><?=htmlspecialchars($errorMessage);?></div>
                        <?php endif; ?>
                    </form>
                </div>
            </main>
        </section>
    </span>
</body>
</html>
