$('questionNice').on('click', function (questionId) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: `/nice/${questionId}`,
      type: "POST",
    })
      .done(function (data, status, xhr) {
        console.log(data);
      })
      .fail(function (xhr, status, error) {
        console.log();
      });
  }
)