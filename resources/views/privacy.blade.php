@extends('layouts.app')　
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>日韓質問|{{ $question->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="question-show-inner col-12 col-lg-7 bg-white mx-auto border-bottom  border-secondary rounded">
                    <p>日韓質問 ha-il-jil-mun（以下、「当サイト」と言います。）では、お客様からお預かりする個人情報の重要性を強く認識しており、個人情報の保護に関する法律、その他の関係法令を遵守すると共に、以下に定めるプライバシーポリシーに従って、個人情報を安全かつ適切に取り扱うことを宣言します。</p>

                    <h3>１．個人情報の定義</h3>
                    
                    <p>本プライバシーポリシーにおいて、個人情報とは生存する個人に関する情報であり、氏名、生年月日、住所、電話番号、メールアドレス等、特定の個人を識別することができるものをいいます。</p>
                    
                    <h3>２．個人情報の管理</h3>
                    
                    <p>お客様からお預かりした個人情報は、不正アクセス、紛失、漏えい等が起こらないよう、慎重かつ適切に管理します。</p>
                    
                    <h3>３．個人情報の利用目的</h3>
                    
                    <p>当サイトでは、お客様からのお問い合わせ等を通じて、メールアドレス等の個人情報をご提供いただく場合があります。その場合は、以下に示す利用目的のために、適正に利用するものと致します。</p>
                    
                    <p>お問い合わせに対する回答</p>
                    <p>アンケート、ご意見、ご感想の依頼</p>
                    <p>当サイトを改善するために必要な分析などを行うため</p>
                    <p>新サービスの開発を行うために必要な分析等を行うため</p>
                    <p>個人情報を含まない形でデータを集計し、当サイト、及びお客様の参考資料を作成するため</p>
                    
                    <h3>４．個人情報の第三者提供</h3>
                    
                    <p>お客様からお預かりした個人情報を、個人情報保護法その他の法令に基づき開示が認められる場合を除き、お客様ご本人の同意を得ずに第三者に提供することはありません。</p>
                    
                    <h3>５．個人情報の開示・訂正・削除について</h3>
                    
                    <p>お客様からお預かりした個人情報の確認、訂正・削除等をご希望の場合、お客様ご本人がこちらのメール（haniljilmun@gmail.com)にご連絡ください。</p>
                    
                    <h3>６．当サイトへのコメントについて</h3>
                    
                    <p>当サイトでは、スパム・荒らしへの対応として、お客様がコメントを投稿した際、使用されたIPアドレスを記録しています。</p>
                    
                    <p>取得したIPアドレスをスパム・荒らしへの対応以外に記録されたIPアドレスを使用することはありません。</p>
                    
                    <p>お客様が投稿された質問、回答、コメントは当サイト運営者がその内容を確認し、以下の内容を含むものは削除する事がありますことを予めご了承ください。</p>
                    
                    <ul>
                        <li><p>特定の個人または法人を誹謗し、中傷するもの</p></li>
                        <li><p>極度にわいせつな内容を含むもの</p></li>
                        <li><p>禁制品の取引に関するもの、他者を害する行為の依頼など、法律によって禁止されている物品・行為の依頼や斡旋などに関するもの</p></li>
                        <li><p>その他、公序良俗に反し、または運営者によって承認すべきでないと認められるもの</p></li>
                    </ul>
                    
                    <!--<h3>７．アクセス解析ツールについて</h3>-->
                    
                    <!--<p>当サイトは、Googleが提供するアクセス解析ツール「Googleアナリティクス」を利用しています。Googleアナリティクスは、Cookieを使用することでお客様のトラフィックデータを収集しています。</p>-->
                    
                    <!--<p>お客様はブラウザの設定でCookieを無効にすることで、トラフィックデータの収集を拒否することができます。</p>-->
                    
                    <!--<p>なお、トラフィックデータからお客様個人を特定することはできません。詳しくはGoogleアナリティクス利用規約をご確認ください。</p>-->
                    
                    <h3>7．Cookie（クッキー）について</h3>
                    
                    <p>Cookie（クッキー）とは、お客様のサイト閲覧履歴を、お客様のコンピュータにデータとして保存しておく仕組みです。</p>
                    
                    <p>なお、Cookieに含まれる情報は当サイトや他サイトへのアクセスに関する情報のみであり、氏名、住所、メール アドレス、電話番号などの個人情報は含まれません。</p>
                    
                    <p>従って、Cookieに保存されている情報からお客様個人を特定することはできません。</p>
                    
                    <!--<h3>９．広告の配信について</h3>-->
                    
                    <!--<p>当サイトでは、第三者配信の広告サービス（Googleアドセンス、 A8.net、afb、バリューコマース、felmat、アクセストレード、infotop）を利用しています。</p>-->
                    
                    <!--<p>上記広告配信事業者は、お客様の過去のアクセス情報に基づいて、適切な広告を配信する場合があります。</p>-->
                    
                    <!--<p>Googleアドセンスについて</p>-->
                    
                    <!--<p>Googleアドセンスによる広告配信プロセスの詳細や、Cookieを用いた情報が広告配信事業者に使用されないようにする方法については、Google広告設定から、Cookieを使用したパーソナライズ広告を無効にできます。</p>-->
                    
                    <!--<p>Amazonアソシエイトについて</p>-->
                    
                    <!--<p>当サイトは、Amazon.co.jpを宣伝しリンクすることによってサイトが紹介料を獲得できる手段を提供することを目的に設定されたアフィリエイトプログラムである、Amazonアソシエイト・プログラムの参加者です。</p>-->
                    
                    <h3>9．免責事項</h3>
                    
                    <p>当サイトに掲載されている情報・資料の内容については、利用、使用、ダウンロードする等の行為に起因して生じる結果に対し、一切の責任を負いません。</p>
                    
                    <p>なお、当サイトに掲載された情報の正確性を鑑みた際に、予告なしで情報の変更・削除を行う場合がございますので、予めご了承ください。</p>
                    
                    <p>当サイト上におけるお客様同士のトラブルに対し、一切の責任を負いません。</p>
                    
                    <p>上記、ご了承ください。</p>
                    
                    <h3>１0．著作権について</h3>
                    
                    <p>当サイトに掲載している、文章・画像・動画等の著作物を無断で複製し、転載することを禁じます。</p>
                    
                    <p>なお、当サイトに掲載している文章を引用する際は、出典元の明記をお願い致します。</p>
                    
                    <h3>１1．本ポリシーの変更について</h3>
                    
                    <p>当サイトは、法令の制定、改正等により、本ポリシーを適宜見直し、予告なく変更する場合があります。</p>
                    
                    <p>本ポリシーの変更は、変更後の本ポリシーが当サイトに掲載された時点、またはその他の方法により変更後の本ポリシーが閲覧可能となった時点で有効になります。</p>
                    
                    <h3>その他お問い合わせ</h3>
                    
                    <p>その他お問い合わせはこちらのメールアドレス(haniljilmun@gmail.com)にご連絡ください。</p>
                    
                    <p>以上</p>
                    
                    <p>制定日：2022年10月18日</p>
                    <div class="footer py-3 text-center">
                        <a href="/" class="btn btn-secondary rounded">ホームへ戻る&ensp;<i class="fas fa-home"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection