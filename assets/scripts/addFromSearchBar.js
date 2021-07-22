const books = document.getElementsByClassName('add-books');

for (let i = 0; i < books.length; i++) {
    books[i].addEventListener('click', () => {
        event.preventDefault();

        const addBook = {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body : books[i].dataset.author,
        }
    /*    fetch(books[i].dataset.path, addBook)
            .then(res => response.json)
            .then(res => console.log(response))
    });*/
})}