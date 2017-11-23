<?php
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
unset($_SESSION['errorMessage']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Instagram</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<section class="bss">
<main>
    <article class="article">
        <div class="ldiv">
            <img class="instaMain" src="images/instaMain.jpg">
        </div>
        <div class="rdiv">
            <div class="rd1">
                <img class="instaLogo" src="images/instaLogo.jpg">
                <div>
                        <h2>친구들의 사진과 동영상을 보려면 가입하세요.</h2>
                        <span class="span">
                            <button src="">Facebook으로 로그인</button>
                        </span>
                        <div>
                            <p>
                            <div><hr color="#ccc" size="1" width="110px" noshade>&nbsp;&nbsp;&nbsp;또는&nbsp;&nbsp;&nbsp;<hr color="#ccc" size="1" width="110px" noshade></div>
                            <p>
                        </div>
                        <form>
                            <div>
                                <input type="text" name="email" placeholder="이메일 주소 (example@gmail.com)">
                            </div>
                            <p></p>
                            <div>
                                <input type="text" name="name" placeholder="성명 (한글 2~4자)">
                            </div>
                            <p></p>
                            <div>
                                <input type="text" name="nickname" placeholder="닉네임 (영어,숫자 2~8자)">
                            </div>
                            <p></p>
                            <div>
                                <input type="password" name="password" placeholder="비밀번호 (영어,숫자 8~16자)">
                            </div>
                            <p></p>
                            <div>
                                <span class="span">
                                    <button type="submit" name="submit" formmethod="post" formaction="register.php">가입</button>
                                </span>
                            </div>
                            <br>
                            <?php if($errorMessage): ?>
                                <div class="errorMessage"><?=htmlspecialchars($errorMessage);?></div>
                            <?php endif; ?>
                            <p>가입하면 Instagram의 <a href="">약관</a> 및 <a href="">개인정보 처리방침</a>에 동의하게 됩니다.</p>
                        </form>
                    </div>
                </div>
            <div class="rd2">
                <p>
                    계정이 있으신가요?
                    <a id="logina" href="login.php">로그인</a>
                </p>
            </div>
            <div>
                <p>앱을 다운로드하세요.</p>
                <div class="appDown">
                    <a href=""><img class="appStore" alt="App Store에서 이용 가능" src="images/appStore.jpg"></a>
                    <a href=""><img class="googlePlay" alt="Google Play에서 이용 가능" src="images/googlePlay.jpg"></a>
                </div>
            </div>
        </div>
    </article>
</main>
<footer>
    <div class="foo">
        <nav>
            <ul>
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
</section>
</body>
</html>
