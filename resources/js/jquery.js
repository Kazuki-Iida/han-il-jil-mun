// アップロードされた画像ファイルの名前表示
$('#imageInput').on('change', function () {
    var file = "";
    var arrLength = $(this).prop('files');
    file += "<ul>";
    for (var i=0; i<arrLength.length; i++){
      file += "<li>"
      file += $(this).prop('files')[i].name;
      file += "</li>";
    }
    file += "</ul>";
    
    $('#fileSelected').html(file);
});


// 質問のいいね
$(function () {
  let questionLike = $('.question-like-toggle');
  let likeQuestionId;
  questionLike.on('click', function () {
    let $this = $(this);
    likeQuestionId = $this.data('question-id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/questions/like',
      method: 'POST',
      data: {
        'question_id': likeQuestionId
      },
    })

    .done(function (data) {
      $this.toggleClass('liked');
      $this.next('.like-counter').html(data.question_likes_count);
    })
 
    .fail(function () {
      console.log('fail'); 
    });
  });
});


// 回答のいいね
$(function () {
  let answerLike = $('.answer-like-toggle');
  let likeAnswerId;
  answerLike.on('click', function () {
    let $this = $(this);
    likeAnswerId = $this.data('answer-id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/answers/like',
      method: 'POST',
      data: {
        'answer_id': likeAnswerId
      },
    })

    .done(function (data) {
      $this.toggleClass('liked');
      $this.next('.like-counter').html(data.answer_likes_count);
    })
 
    .fail(function () {
      console.log('fail');
    });
  });
});


// 削除確認アラート
$('.delete-btn').on('click', function check(){
	if(window.confirm('削除してよろしいですか？')){
		return true;
	}
    else{ 
		window.alert('キャンセルされました');
		return false;
	}
});