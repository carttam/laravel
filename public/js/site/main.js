/*Show Comment*/
$(document.getElementsByClassName('comments')).each(function () {
    this.onclick = function () {
        $.ajax({
            url: "http://localhost/lara/public/home/getComments/" + this.attributes['data-id'].value
            , dataType: 'json'
            , success: function (result) {
                const content = document.getElementById('modal-content');
                content.innerHTML = '';
                for (const resultKey in result) {
                    const col12 = document.createElement('div');
                    const card = document.createElement('div');
                    const card_body = document.createElement('div');
                    const user_full_name = document.createElement('h6');
                    const comment = document.createElement('p');

                    col12.className = 'col-12';
                    card.className = 'card';
                    card_body.className = 'card-body';
                    user_full_name.className = 'card-subtitle mb-2 text-muted';
                    comment.className = 'card-text';

                    user_full_name.textContent = result[resultKey].user_full_name;
                    comment.textContent = result[resultKey].comment;

                    card_body.appendChild(user_full_name);
                    card_body.appendChild(comment);
                    card.appendChild(card_body);
                    col12.appendChild(card);
                    content.appendChild(col12);
                }
            }
        });
        $('#staticBackdrop').modal('show');
    };
});
