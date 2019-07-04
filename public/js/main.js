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
          <div class="book-info pull-left">
            <h4 class="card-title">${book.title}</h4>
            <span>Written by: ${book.authorName}</span>
            <br />
            <span>In stock: ${book.in_stock}</span>
          </div>
            <form method="POST" action="users/borrow">
              <input type="hidden" name="bookId" value=${book.bookId} />
              <input type="submit" name="class="btn btn-primary ml-auto" value="Borrow" /> 
            </form>
        </div>
      `
    );
    container.innerHTML = tableContent;
  }
};
