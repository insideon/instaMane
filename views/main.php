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
                <section class="mainFeed">
                    <div class="feedFrame">
                        <?php foreach($articles as $article):?>
                            <article>
                                <!-- 등록한 유저 -->
                                <div id="author">
                                    <div>
                                        <a href="/profile.php?nickname=<?=htmlspecialchars($article['authors']['nickname']);?>">
                                            <img class="author_icon" src="<?=htmlspecialchars($article['authors']['icon']);?>" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a class="bold" href="/profile.php?nickname=<?=htmlspecialchars($article['authors']['nickname']);?>">
                                            <?=htmlspecialchars($article['authors']['nickname']);?>
                                        </a>
                                    </div>
                                </div>

                                <!-- 업로드한 사진 -->
                                <div>
                                    <img src="<?=htmlspecialchars($article['pics']['url']);?>">
                                </div>

                                <div class="comments">
                                    <section>
                                        <a href=""><img class="articleIcon" src="images/articleIcon1.jpg"></a>
                                        <a href=""><img class="articleIcon" src="images/articleIcon2.jpg"></a>
                                    </section>
                                    <section>
                                        <!-- 좋아요 -->
                                        <a class="bold" href="">
                                            <span>
                                                좋아요
                                                <?=htmlspecialchars($article['likesCnt']);?>
                                                개
                                            </span>
                                        </a>
                                    </section>
                                    <div class="articleContent">
                                        <!-- 글 내용 -->
                                        <?=htmlspecialchars($article['content']);?>
                                    </div>
                                    <div>
                                        <!-- 코멘트 -->
                                        <ul>
                                            <li><a id="moreComment" href="">댓글 더 보기</a></li>
                                            <li>
                                                <?php foreach($article['comments'] as $comment):?>
                                                    <a class='commentId' href=''><?=htmlspecialchars($comment['nickname']);?></a>
                                                    <?=htmlspecialchars($comment['content']);?><br>
                                                <?php endforeach;?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div></div>
                                    <section>
                                        <span id="timeStamp"><?=date("Y-m-d",strtotime(htmlspecialchars($article['created'])));?></span>
                                        <hr size="1" color="#ccc" noshade>
                                        <p></p>
                                        <form>
                                            <textarea placeholder="댓글 달기..."></textarea>
                                        </form>
                                    </section>
                                </div>
                                <div>
                                    <a href=""><img id="others" src="images/others.jpg"></a>
                                </div>
                            </article>
                        <?php endforeach;?>
                    </div>
                </section>
            </main>
        </section>
    </span>
</body>
</html>
