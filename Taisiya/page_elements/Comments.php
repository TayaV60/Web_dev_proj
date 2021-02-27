<script>

const formComments = document.getElementById("form-comments")

function addRemoveEventListeners() {
    const formCommentLis = formComments.getElementsByTagName('li')

    for (const li of formCommentLis) {
        const a = li.getElementsByTagName("a")[0];
        a.addEventListener('click', function() {
            li.remove();
        })
    }
}

function addComment() {
    const index = formComments.getElementsByTagName('li').length
    formComments.innerHTML += `
    <li>
        <input name="comments[]" size="80" type="text" value="Candidate comment ${index}">
        <a><img class="icon" src="assets/delete.png" alt="Remove Comment"></a>
    </li>`;
    addRemoveEventListeners()
}

if (formComments.getElementsByTagName('li').length < 1) {
    addComment()
}

addRemoveEventListeners()

</script>
