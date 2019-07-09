console.log("js connected!");

generateBookTable = data => {
  let searchBar = document.getElementById("bookSearch");
  let container = document.getElementById("bookTableContainer");
  console.log(searchBar.innerText);
  // blank out previous results
  container.innerHTML = ``;

  // Filter book data to only items that match the search query
  let filteredData = data.filter(book =>
    book.title.toLowerCase().includes(searchBar.value.toLowerCase())
  );
  // Handle search queries with no matches
  if (filteredData < 1) {
    container.innerHTML = `<p>No results found</p>`;
  } else {
    // build HTML for query results, then append to the container
    let tableContent = filteredData.map(
      book =>
        `
        <div class="card card-body mb-3 book-card">
          <img class="book-img" src=${book.img_url || "https://www.bookamo.com/img/book_placeholder.png"} /> 
          <div class="book-info">
                <h4 class="card-title">${book.title}</h4>
                <small><i>Written by: ${book.authorName}</i></small>
          </div>
          <form class="ml-auto" method="POST" action="users/borrow">
            <input type="hidden" name="bookId" value=${book.bookId} />
            <input type="submit" class="btn btn-primary ml-auto" value="Borrow" /> 
          </form>
        </div>
      `
    ).join('');
    container.innerHTML = tableContent;
  }
};


