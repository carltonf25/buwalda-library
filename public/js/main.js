console.log("js connected!");

generateBookTable = data => {
  let searchBar = document.getElementById("bookSearch");
  let container = document.getElementById("bookTableContainer");

  console.log(searchBar.innerText);
  // blank out previous results
  container.innerHTML = ``;

  let filteredData = data.filter(book =>
    book.title.toLowerCase().includes(searchBar.value.toLowerCase())
  );
  if (filteredData < 1) {
    container.innerHTML = `<p>No results found</p>`;
  } else {
    let tableContent = filteredData.map(
      book =>
        `
        <div class="card card-body mb-3 book-card">
                <div class="book-info">
                <h4 class="card-title">${book.title}</h4>
                <span>Written by: ${book.authorName}</span>
                <br />
                <span>In stock: ${book.in_stock}</span>
            </div>
        </div>
      `
    );

    container.innerHTML = tableContent;
  }
};
