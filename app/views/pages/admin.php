<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
  <?php flash('admin_message'); ?>
  <h1>Admin Panel</h1>
  <div class="row">
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/books/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Book
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-10 m-auto mt-4">
    <h2 class="text-center">Borrowed Books</h2>
      <table class="table mt-4">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Borrower</th>
            <th scope="col">Borrow Date</th>
            <th scope="col">Confirm Return</th>
          </tr>
        </thead>
        <tbody id="borrowed-table-body">
        </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  generateTable = (data = [], el) => {
    const container = document.getElementById(el);
    let table = data.map(b => (
      `
    <tr>
      <td>${b.bookTitle}</td>
      <td>${b.authorName}</td>
      <td>${b.userName}</td>
      <td>${b.borrowedDate}</td>
      <td>
        <form method="POST" action="<?php echo URLROOT; ?>/borrowedbooks/delete/">
          <input type="hidden" name="borrowedBookId" value=${b.id} />
          <input class="emoji-btn" type="submit" value="✔" />
        </form>
      </td>
    </tr>
    `
    ))

    container.innerHTML = table;
  }
  generateTable( <?php echo json_encode($data['borrowedBooks']) ?> , "borrowed-table-body")
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>