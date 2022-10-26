<p align="center">
    <a href="https://han-il-jil-mun.herokuapp.com/" target="_blank">
        <img src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/han-il-jil-mun_logo_small.PNG" width="400">
    </a>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-v6.20.44-green.svg" alt="Laravel version">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
    <!-- <a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a> -->
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
<p align="center"><a href="https://han-il-jil-mun.herokuapp.com/">日韓質問 han-il-jil-mun</a></p>

# 日韓質問 han-il-jil-mun

### このWebサイトについて

　このWebサイトは、日韓相互間のQ&Aサイトです。質問投稿の際に、日本に関する質問か韓国に関する質問かを選択することで、質問表示の際に分類され、回答してもらうことができます。韓国の方にもこのwebサイトを利用してもらいたいと考えているので、日本についての質問という項目も作成しました。
 
 </br>
 
### 制作の背景

　製作者自身韓国が好きなのですが、韓国に関する質問を気軽にできる場が欲しいなという気持ちでこのWebサイトを作成しました。また、韓国は反日国と言われることも多く、旅行など行く際に躊躇ってしまう方もいるのではないかと感じ、事実以上に怖がる必要がないように、そして、想像と現実とのギャップを少しでも減らして安心できるようにという願いも込めて作りました。私が韓国を好きなのと同じように韓国にも日本を好きでいてくれている方がいると信じているので、そういう方も安心して日本に旅行に来たり、日本のことを知ったりしていただくため、ゆくゆくは韓国から日本に対しての質問もしていただきたいという思いで、日本に関する質問もできるようにいたしました。
 
  </br>
 
### トップページイメージ

<p align="center">
    <img src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/toppage_img.png" width="80%">
</p>

 </br>

### このWebサイトの使い方

<p>このwebサイトの使い方はこちら（ https://han-il-jil-mun.herokuapp.com/how-to-use ）からご覧ください。</p>

 </br>

### 制作する上で工夫した点

##### ・ページ遷移（ロード、リロード）の回数

<p>Webサイトの使用者の立場に立った時、ページ遷移の回数は少ない方が楽なのではと考え、ユーザー表示画面における様々な機能使用時にモーダルを用いたり、Good機能呼び出し時にjQueryを用いてAjax通信をするよう実装したりすることで、ページの遷移回数を減らすように作成いたしました。</p>

##### ・Bootstrapの利用

<p>今回、初めてBootstrapを使用したのですが、こちらを用いてできることをある程度勉強したことで、違和感のないレスポンシブデザインや一貫性のあるデザインを効率よく作成できたと感じています。</p>

##### ・メール認証とGoogle API

<p>ユーザー登録は仮登録と本登録の二段階で行ってもらえるようにいたしました。仮登録時にユーザーに入力してもらったメールアドレスに本登録用のメールを送信し、メールで送信したリンクをクリックすることで本登録が完了します。存在しないメールアドレスでのユーザー登録や、他人のメールアドレスを用いたユーザー登録を防ぐことができるようになりました。また、APIを用いたGoogleアカウントによるログインもできるようにしたことで、ユーザー登録の利便性を向上させました。</p>

##### ・ランキング機能

<p>投稿した質問に対するGoodが多いユーザーと、回答に対するGoodが多いユーザーをそれぞれ8人までトップページのサイドカラムでランキング表示することで、ユーザーに対していい質問やいい回答を心がけることや、また、たくさん回答しようといった行動の動機付けをできたらと考え、ランキングを実装しました。同じGood数のユーザーがランキング内にいた場合は、順位を同率にするよう工夫いたしました。</p>

##### ・トップページの並べ替え、フィルター

<p>トップページの質問一覧画面で、「日本に関する質問」「韓国に関する質問」のフィルターと、カテゴリーによるフィルター、「Good順」と「新着順」による並べ替え、そして検索によるフィルターを同時にできるようにしたことで、ユーザーが求めている質問を見つけやすいようにしています。</p>

<p>これらの他にも、ユーザーフォロー機能や、質問回答コメント投稿者のIPアドレス取得、通報機能、AWSのストレージサービスS3の使用なども工夫した点です。</p>


 </br>
 
### 環境
 
 <p>・AWS</p>
 
 <p>・Laravel 6.20.44</p>
 
  </br>
  
### ER図

<img src="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/ER_img.png" width="90%">

</br>
  
 ### 制作者情報
 
 <p>作成：飯田一希</p>
 <p>問い合わせは（ haniljilmun@gmail.com )にお願いいたします。</p>
 
  </br>
  
 
