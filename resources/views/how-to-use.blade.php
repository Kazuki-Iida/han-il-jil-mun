@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@section('title', 'このサイトの使い方')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="container">
            <div class="content how-to-use">
                <div class="content-inner col-12 col-lg-10 bg-white mx-auto p-4 pt-5 rounded">
                    <div class="title mb-5">
                        <h2 class="text-nowrap">このサイトの使い方&thinsp;<i class="far fa-question-circle"></i></h2>
                    </div>
                    
                    <div class="border border-secondary p-4 w-50 how-to-use-index">
                        <h4 class="m-2">目次</h4>
                        <ul>
                            <li><a href="#register">●ユーザー登録</a></li>
                            <li><a href="#login">●ログイン</a></li>
                            <li><a href="#toppage">●トップページ</a></li>
                            <li><a href="#question-post">●質問の投稿</a></li>
                            <li><a href="#question-show">●質問とスレッド</a></li>
                            <li><a href="#answer">●回答・コメントする</a></li>
                            <li><a href="#profile">●プロフィール</a></li>
                            <li><a href="#privacy">●お問い合わせとプライバシーポリシー</a></li>
                        </ul>
                    </div>
                    
                    <div id="register" class="explanation my-5">
                        <h3 class="mb-3">ユーザー登録</h3>
                        <p>ユーザー登録やログインをしなくても、「質問や回答の閲覧」、「ユーザー情報の閲覧」は行うことができますが、ユーザー登録やログインをすることで、全ての機能をご利用いただけます。</p>
                        <img class="border border-secondary explain-img ml-sm-3" src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/how_to_use/register_page.png" alt="how to use register page" width=60% height=auto>
                        <p class="mt-3">任意のユーザー名、お持ちのメールアドレス、任意のパスワードを入力し、水色の仮登録ボタンを押してください。ご入力いただいたメールアドレスに本登録用のリンクが送信されますので、そちらをクリックしていただくとユーザー登録が完了します。</p>
                        <p>Googleのアカウントをお持ちの方は画面下部の「Sign in with Google」のボタンからより簡単にユーザー登録をしていただけますが、本登録用のリンクのクリックは忘れないようにお願いいたします。</p>
                    </div>
                    
                    <div id="login" class="explanation my-5">
                        <h3 class="mb-3">ログイン</h3>
                        <img class="border border-secondary explain-img ml-sm-3" src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/how_to_use/login_page.png" alt="how to use login page" width=60% height=auto>
                        <p class="mt-3">ユーザー登録の際にご登録いただいたメールアドレス、パスワードを入力し、水色のログインボタンを押してください</p>
                        <p>Googleのアカウントをお持ちの方やGoogleアカウントでご登録いただいた方は、画面下部の「Sign in with Google」のボタンからより簡単にログインをしていただけます。</p>
                        <p>パスワードを忘れてしまった場合は、「パスワードを忘れた場合」というリンクから、メールアドレスを入力していただくと、パスワード再設定用のメールをお送りいたします。</p>
                    </div>
                    
                    <div id="toppage" class="explanation my-5">
                        <h3 class="mb-3">トップページ</h3>
                        <p>トップページでは様々な質問を一覧表示で見ることができます。</p></br>
                        <img class="border border-secondary explain-img ml-sm-3" src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/how_to_use/index_filter.png" alt="how to use index-filter" width=70% height=auto>
                        <p class="mt-3">また、上図の検索欄や「韓国についての質問」「日本についての質問」、「Goodの多い順」「新着順」を選択することで、複数のフィルタリングを同時にかけることができます。</p></br>
                        <p>さらに、サイドメニューのカテゴリーをクリックすることで、カテゴリーによるフィルターも追加することができます。カテゴリー一覧はそのカテゴリーの質問が多いものが上に来るよう並んでいます。</p></br>
                        <p>もし興味のある質問があった場合には、質問ごとの右下にある回答数を確認して、回答がついていれば質問をクリックして回答を見てみましょう。</p>
                        <p>トップページでは質問一覧の他にも、サイドメニューで質問に多くのGoodをつけられた人、回答に多くのGoodをつけられた人をそれぞれ8人ずつランキング表示しています。</p>
                    </div>
                    
                    <div id="question-post" class="explanation my-5">
                        <h3 class="mb-3">質問の投稿</h3>
                        <p>ログインユーザーは、トップページの上の画像にもある、「質問を投稿」という紫色のボタンから、質問を投稿することができます。</p></br>
                        <p>質問投稿の際には、タイトル（必須）、質問内容（必須）、画像（4枚まで任意）、カテゴリー（必須）、どちらの国に関する質問か（必須）を入力して送信ボタンをクリックしてください。</p>
                        <p>質問後も質問の編集、削除はできますが、画像の変更、編集はできないのでご注意ください。</p>
                    </div>
                    
                    <div id="question-show" class="explanation my-5">
                        <h3 class="mb-3">質問とスレッド</h3>
                        <p>トップページから質問をクリックすることでその質問の回答とコメントををみることができます。</p>
                        <img class="border border-secondary explain-img ml-sm-3" src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/how_to_use/question_show_page.png" alt="how to use question's show page" width=40% height=auto>
                        <p class="mt-3">上図のように表示され、質問、回答、コメントの投稿者は右上の詳細ボタンから質問の編集と削除ができます。質問の投稿者以外は右上の詳細ボタンから通報をすることができます。</p>
                        <p>ログインユーザーであれば、質問の左下にあるGoodボタン<i class="fas fa-thumbs-up"></i>からGoodを押すことができます。Goodした質問は自分のプロフィールから確認することができます。</p>
                        <p>また、ログインユーザーは回答の左下にあるGoodボタン<i class="fas fa-arrow-alt-circle-up"></i>も押すことができ、Goodの多い質問はこの画面でより上位に表示されるようになります。</p>
                    </div>
                    
                    <div id="answer" class="explanation my-5">
                        <h3 class="mb-3">回答・コメントする</h3>
                        <p>ログインユーザーは、上の画像にもある、「回答する」と、「コメントする」または「コメントを追加」という紫色のボタンから、回答やコメントをすることができます。</p></br>
                        <p>回答・コメントの際には、内容（必須）、画像（4枚まで任意）を入力して送信ボタンをクリックしてください。</p>
                        <p>回答・コメント後も編集、削除はできますが、画像の変更、編集はできないのでご注意ください。</p>
                    </div>
                    
                    <div id="profile" class="explanation my-5">
                        <h3 class="mb-3">プロフィール</h3>
                        <p>ヘッダーに表示されている自分のユーザー名をクリックすると自分のプロフィールを見ることができます。</p>
                        <p>また、サイト各所の他の人のユーザーネームやプロフィール画像をクリックすることで他の人のプロフィールを見ることもできます。</p>
                        <img class="border border-secondary explain-img ml-sm-3" src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/how_to_use/profile_show_page.png" alt="how to use profile show page" width=70% height=auto>
                        <p class="mt-3">上図のように表示され、自分のプロフィール画面では「プロフィールを編集する」ボタン、他のユーザーのプロフィール画面では「フォロー」「フォロー解除」のボタンが表示されます。</p>
                        <p>プロフィールを編集することで、プロフィール画面にプロフィール文や興味・趣味（3つまで）が表示されます。これは他のユーザーも見ることができます。プロフィール画像も変更することができます。</p>
                        <p>フォローしたユーザー、フォローされているユーザーは、フォローやフォロワーの人数の部分をクリックすることで一覧表示することができます。興味関心の合うユーザーや、自分の興味がある質問をしているユーザーがいたらフォローしてみましょう。</p>
                        <p>「Goodした質問」ボタンや「このユーザーの質問」ボタンをクリックすることでそれらを表示することができます。</p>
                    </div>
                    
                    <div id="privacy" class="explanation my-5">
                        <h3 class="mb-3">お問い合わせとプライバシーポリシー</h3>
                        <p>プライバシーポリシー・免責事項はトップページフッターのリンクからご確認いただけます。</p>
                        <p>お問い合わせもそちらに記載のメールアドレス（haniljilmun@gmail.com）にお願いいたします。</p>
                    </div>
                    <div class="footer py-3 text-center">
                        <a href="/" class="btn btn-secondary rounded">ホームへ戻る&ensp;<i class="fas fa-home"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection