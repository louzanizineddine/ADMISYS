var quill = new Quill('#editor', {
    theme: 'snow'
});

// Assuming you have a button with an ID "saveButton" to trigger the save operation
const saveButton = document.getElementById('update-article-content');
const testDiv = document.getElementById('test');

saveButton.addEventListener('click', (e) => {
    e.preventDefault();
    const editorContent = quill.root.innerHTML;
    let url = new URL(window.location.href);
    let id = url.searchParams.get("id");

    const data = {
        editorContent: editorContent,
        id: id
    };

    // Make an AJAX request to the server
    fetch('save-article-content.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.text())
        .then(result => {
            console.log(result); // Output the response from the server
            // redirect to the article page
            window.location.href = "news.php";
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
