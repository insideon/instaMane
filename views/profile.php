<?php
if (!isset($_SESSION['is_login'])) {
    header('Location: login.php');
    exit;
}
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
                    <form method="post" action="logout_process.php"><input style="width: 70px;" type="submit" name="logout" value="로그아웃"></form>
                    <div></div>
                    <div><a href=""><img class="topLogo2" src="images/insta1.jpg"></a></div>
                    <div><a href=""><img class="topLogo2" src="images/insta2.jpg"></a></div>
                    <div><a href=""><img class="topLogo2" src="images/insta3.jpg"></a></div>
                </div>
            </nav>
            <main>
                <div class="pfframe">
                    <header class="pf1">
                        <div class="pf11"><a href=""><img class="pficon" src="<?=htmlspecialchars($author['icon']);?>"></a></div>
                        <div class="pf12">
                            <div class="pfc1">
                                <span class="pfc11"><?=htmlspecialchars($author['nickname']);?></span>
                                <a class="pfc12" href=""><span class="nospan">프로필 편집</span></a>
                                <a class="pfc12" href=""><span class="nospan">수정</span></a>
                            </div>
                            <ul class="pfc2">
                                <li>게시물 <b><?=htmlspecialchars(count($article));?></b></li>
                                <li>팔로워 <b>53.8K</b></li>
                                <li>팔로우 <b>0</b></li>
                            </ul>
                            <b>설명</b>
                        </div>
                    </header>
                    <div class="pf2">
                        <?php $i=0; ?>
                        <?php foreach ($article as $row): ?>
                            <?php if ($i%3==0): ?>
                                <div class="rows">
                            <?php endif ?>

                            <div class="pfarticle"><img src="<?=htmlspecialchars($row['url']);$i++?>"></div>

                            <?php if ($i%3==0): ?>
                                </div>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                </main>
                <footer>
                    <div class="foo">
                        <nav>
                            <ul class="fooul">
                                <li><a href="">INSTAGRAM 정보</a></li>
                                <li><a href="">지원</a></li>
                                <li><a href="">블로그</a></li>
                                <li><a href="">홍보 센터</a></li>
                                <li><a href="">API</a></li>
                                <li><a href="">채용정보</a></li>
                                <li><a href="">개인정보처리방침</a></li>
                                <li><a href="">약관</a></li>
                                <li><a href="">디렉터리</a></li>
                                <li><a href="">언어</a></li>
                            </ul>
                            <span class="span">© 2017 Instagram</span>
                        </nav>
                    </div>
                </footer>
                </div>
        </section>
    </span>
</body>
</html>
