<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/e69ac45242.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <style>
    .card-img-top {
      height: 30vh;
      object-fit: fill;
    }

    a:hover {
      text-decoration: underline !important;
    }

    .row {
      --bs-gutter-x: 0 !important;
    }

    #logoImg {
      width: 50px;
    }

    #authorsSection,
    #categoriesSection,
    #commentsSection,
    #editBook,
    #deleteAuthorMsg,
    #editAuthor,
    #editCategory {
      display: none;
    }
  </style>
  <script src="./main.js"></script>
</head>

<body class="font-monospace bg-light">
  <header>
    <div class="container-fluid p-0">
      <div class="row">
        <nav class="navbar px-5 bg-dark text-white">
          <div class="d-flex flex-column align-items-center justify-content-center">
            <img src="../images/Logo.png" alt="logo" id="logoImg" />
            <span class="fs-5">Brainster Library</span>
          </div>
          <div id="userLog" class="d-flex align-items-center">
            <p class="text-warning d-inline-block mx-2 text-capitalize mb-0"></p>
            <button class="btn btn-outline-warning mx-2" onclick="logOut()">Log out</button>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <main>
    <div class="row">
      <div class="col-2 position-sticky p-2 pt-5">
        <div class="position-sticky wrapper">
          <input type="radio" class="btn-check" name="options" id="books" autocomplete="off" checked />
          <label class="btn btn-secondary d-block m-3" for="books">Books</label>

          <input type="radio" class="btn-check" name="options" id="authors" autocomplete="off" />
          <label class="btn btn-secondary d-block m-3" for="authors">Authors</label>

          <input type="radio" class="btn-check" name="options" id="categories" autocomplete="off" />
          <label class="btn btn-secondary d-block m-3" for="categories">Categories</label>

          <input type="radio" class="btn-check" name="options" id="comments" autocomplete="off" />
          <label class="btn btn-secondary d-block m-3" for="comments">Comments</label>
        </div>
      </div>
      <div class="col-10 shadow-lg pb-5">
        <section id="booksSection" class="sections">
          <h2 class="text-center my-5 fs-1">Books</h2>
          <div class="row">
            <div class="col-8 row" id="booksRow"></div>
            <div class="col-4 p-4" id="addBook">
              <h2 class="text-center fs-2">Add a new Book</h2>
              <?php
              if (isset($_GET['existMsg'])) {
                echo '<p class="alert alert-warning text-center">' . $_GET['existMsg'] . '</p>';
              }
              if (isset($_GET['successMsg'])) {
                echo '<p class="alert alert-success text-center">' . $_GET['successMsg'] . '</p>';
              }
              ?>
              <form action=".././CRUD's/addItem.php" method="post">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" class="form-control mb-3" required />
                <label for="author" class="form-label">Author:</label>
                <select name="author" id="author" class="form-select mb-3" required>
                  <option value="" disabled selected>
                    Choose an author
                  </option>
                </select>
                <label for="yearPublished" class="form-label">Year published:</label>
                <input type="number" name="yearPublished" id="yearPublished" class="form-control mb-3" required />
                <label for="numberOfPages" class="form-label">Number of pages:
                </label>
                <input type="number" name="numberOfPages" id="numberOfPages" class="form-control mb-3" required />
                <label for="img" class="form-label">Image url:</label>
                <input type="url" name="img" id="img" class="form-control mb-3" required />
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category" class="form-select mb-3" required>
                  <option value="" disabled selected>Choose category</option>
                </select>
                <input type="text" name="item" value="book" class="d-none">
                <button type="submit" class="btn btn-primary">Add</button>
              </form>
            </div>
            <div class="col-4 p-4" id="editBook">
              <h2 class="text-center fs-2">Edit Book</h2>
              <?php
              if (isset($_GET['sucessMsg'])) {
                echo '<p class="alert alert-success">' . $_GET['successMsg'] . '</p>';
              }
              ?>
              <form action=".././CRUD's/editItem.php" method="post">
                <label for="editTitle" class="form-label">Title:</label>
                <input type="text" name="title" id="editTitle" class="form-control mb-3" required />
                <input type="text" name="oldTitle" id="oldTitle" class="d-none">
                <label for="editAuthorSelect" class="form-label">Author:</label>
                <select name="author" id="editAuthorSelect" class="form-select mb-3" required>
                  <option value="" disabled>
                    Choose an author
                  </option>
                </select>
                <input type="number" name="oldAuthor" id="oldAuthor" class="d-none">
                <label for="editYearPublished" class="form-label">Year published:</label>
                <input type="number" name="yearPublished" id="editYearPublished" class="form-control mb-3" required />
                <label for="editNumberOfPages" class="form-label">Number of pages:
                </label>
                <input type="number" name="numberOfPages" id="editNumberOfPages" class="form-control mb-3" required />
                <label for="editImg" class="form-label">Image url:</label>
                <input type="url" name="img" id="editImg" class="form-control mb-3" required />
                <label for="editBookCategory" class="form-label">Category:</label>
                <select name="category" id="editBookCategory" class="form-select mb-3" required>
                  <option value="" disabled>Choose category</option>
                </select>
                <input type="text" name="item" value="book" class="d-none">
                <input type="number" name="bookId" id="bookId" class="d-none">
                <button type="button" class="btn btn-danger" id="cancelBtn">Cancel</button>
                <button type="submit" class="btn btn-warning">Update</button>
              </form>
            </div>
          </div>
        </section>
        <section id="authorsSection" class="sections">
          <h2 class="text-center my-5 fs-1">Authors</h2>
          <div class="row">
            <div class="col-8 p-4" id="authorsRow">
              <div id="deleteAuthorMsg"></div>
              <table class="table table-striped table-hover">
                <tr>
                  <th>Id</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Short biography</th>
                  <th></th>
                </tr>
              </table>
            </div>
            <div class="col-4 p-4" id="addAuthor">
              <h2 class="text-center fs-2">Add a new Author</h2>
              <?php
              if (isset($_GET['existAuthorMsg'])) {
                echo '<p class="alert alert-warning text-center">' . $_GET['existAuthorMsg'] . '</p>';
              }
              if (isset($_GET['successAuthorMsg'])) {
                echo '<p class="alert alert-success text-center">' . $_GET['successAuthorMsg'] . '</p>';
              }
              ?>
              <form action=".././CRUD's/addItem.php" method="post">
                <label for="firstName" class="form-label">First name:</label>
                <input type="text" name="firstName" id="firstName" class="form-control mb-3" required>
                <label for="lastName" class="form-label">Last name:</label>
                <input type="text" name="lastName" id="lastName" class="form-control mb-3" required>
                <label for="shortBio" class="form-label">Short biography:</label>
                <textarea name="shortBio" id="shortBio" class="form-control mb-3"
                  placeholder="The biography must contain minimal 20 characters"></textarea>
                <p id="bioMsg"></p>
                <input type="text" name="item" value="author" class="d-none">
                <button class="btn btn-primary">Add</button>
              </form>
            </div>
            <div class="col-4 p-4" id="editAuthor">
              <h2 class="text-center fs-2">Edit Author</h2>
              <?php
              if (isset($_GET['existAuthorMsg'])) {
                echo '<p class="alert alert-warning text-center">' . $_GET['existAuthorMsg'] . '</p>';
              }
              if (isset($_GET['successAuthorMsg'])) {
                echo '<p class="alert alert-success text-center">' . $_GET['successAuthorMsg'] . '</p>';
              }
              ?>
              <form action=".././CRUD's/editItem.php" method="post">
                <label for="editFirstName" class="form-label">First name:</label>
                <input type="text" name="firstName" id="editFirstName" class="form-control mb-3" required>
                <input type="text" name="oldFirstName" id="oldFirstName" class="d-none">
                <label for="editLastName" class="form-label">Last name:</label>
                <input type="text" name="lastName" id="editLastName" class="form-control mb-3" required>
                <input type="text" name="oldLastName" id="oldLastName" class="d-none">
                <label for="editShortBio" class="form-label">Short biography:</label>
                <textarea name="shortBio" id="editShortBio" class="form-control mb-3"
                  placeholder="The biography must contain minimal 20 characters"></textarea>
                <p id="editBioMsg"></p>
                <input type="text" name="item" value="author" class="d-none">
                <input type="number" name="authorId" id="authorId" class="d-none">
                <button type="button" class="btn btn-danger" id="cancelEditAuthor">Cancel</button>
                <button class="btn btn-warning">Update</button>
              </form>
            </div>
          </div>
        </section>
        <section id="categoriesSection" class="sections">
          <h2 class="text-center my-5 fs-1">Categories</h2>
          <div class="row">
            <div class="col-8 p-4" id="categoriesRow">
              <div id="deleteCategoryMsg"></div>
              <table class="table table-striped table-hover w-75">
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th></th>
                </tr>
              </table>
            </div>
            <div class="col-4 p-4" id="addCategory">
              <h2 class="text-center fs-2">Add a new Category</h2>
              <?php
              if (isset($_GET['existCategoryMsg'])) {
                echo '<p class="alert alert-warning text-center">' . $_GET['existCategoryMsg'] . '</p>';
              }
              if (isset($_GET['successCategoryMsg'])) {
                echo '<p class="alert alert-success text-center">' . $_GET['successCategoryMsg'] . '</p>';
              }
              ?>
              <form action=".././CRUD's/addItem.php" method="post">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control mb-3" required>
                <input type="text" name="item" value="category" class="d-none">
                <button class="btn btn-primary">Add</button>
              </form>
            </div>
            <div class="col-4 p-4" id="editCategory">
              <h2 class="text-center fs-2">Edit Category</h2>
              <?php
              if (isset($_GET['existCategoryMsg'])) {
                echo '<p class="alert alert-warning text-center">' . $_GET['existCategoryMsg'] . '</p>';
              }
              if (isset($_GET['successCategoryMsg'])) {
                echo '<p class="alert alert-success text-center">' . $_GET['successCategoryMsg'] . '</p>';
              }
              ?>
              <form action=".././CRUD's/editItem.php" method="post">
                <label for="editName" class="form-label">Name:</label>
                <input type="text" name="name" id="editName" class="form-control mb-3" required>
                <input type="text" name="item" value="category" class="d-none">
                <input type="number" name="categoryId" id="categoryId" class="d-none">
                <button type="button" class="btn btn-danger" id="cancelEditCategory">Cancel</button>
                <button class="btn btn-warning">Update</button>
              </form>
            </div>
          </div>
        </section>
        <section id="commentsSection" class="sections">
          <h2 class="text-center my-5 fs-1">Comments</h2>
          <div id="commentMsg"></div>
          <div class="row">
            <div id="commentsRow" class="col-6 p-4">
              <h2 class="text-center fs-2 mb-5">Waithing for approval</h2>
            </div>
            <div id="rejectedCommentsRow" class="col-6 p-4">
              <h2 class="text-center fs-2 mb-5">Rejected</h2>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
  <footer class="bg-dark text-light py-2">
    <div class="container text-center">
      <h2 class="fs-1 m-0">&OpenCurlyQuote;&OpenCurlyQuote;</h2>
      <div id="quote" class="w-75 mx-auto"></div>
      <p class="m-0">
        Made with <span class="text-danger">&hearts;</span> by Brainster
        students
      </p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="./main.js"></script>

  <script>
    $(document).ready(function () {
      // getting the books
      $.ajax({
        url: ".././CRUD's/books.php",
        success: function (response) {
          $.each(response, function (index, value) {
            $("#booksRow").append(`<div class="col-4 p-3 cardWrapper ${value.name}">
                                                <div class="card shadow-sm" id="${value.id}">
                                                  <img src="${value.img}" class="card-img-top" alt="book cover image">
                                                  <div class="card-body pb-2 pt-0">
                                                    <h3 class="card-title text-center">${value.title}</h3>
                                                    <p class="card-text text-capitalize"><i class="fa-solid fa-user-pen d-inline-block me-1"></i><span id='FN'>${value.first_name}</span> ${value.last_name}</p>
                                                    <p class="text-end text-secondary mb-1"><i class="fa-solid fa-tags d-inline-block me-2"></i>${value.name}</p>
                                                    <div class="d-flex justify-content-around mt-3">
                                                    <button class="btn btn-sm btn-warning editBtns" data-id="${value.id}" data-year="${value.year_published}" data-pages="${value.number_of_pages}" data-type="book" data-author="${value.author_id}" data-category="${value.category_id}">Edit</button> 
                                                    <button class="btn btn-sm btn-danger deleteBtns" data-id="${value.id}" data-type="book">Delete</button> 
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>`);
          });
          $(".deleteBtns").click(function () {
            swal({
              title: "Are you sure?",
              text: "With deleting the book,all of its comments and notes will be deleted also",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                swal("Poof! Your book has been deleted!", {
                  icon: "success",
                }).then(() => {
                  $.ajax({
                    url: ".././CRUD's/deleteItem.php",
                    type: "POST",
                    data: {
                      id: $(this).data("id"),
                      item: $(this).data("type"),
                    },
                    success: function (response) {
                      location.reload();
                    }
                  });
                });
              } else {
                swal("Your book is safe!");
              }
            });
          });
          $('.editBtns').click(function () {
            $('#addBook').hide();
            $('#editBook').show();
            let bookImg = ($(`#${$(this).data('id')} img`).attr('src'));
            let bookTitle = ($(`#${$(this).data('id')} .card-title`).text());
            $('#editTitle').val(bookTitle);
            $('#oldTitle').val(bookTitle);
            $('#editImg').val(bookImg);
            $('#editYearPublished').val($(this).data('year'));
            $('#editNumberOfPages').val($(this).data('pages'));
            $('#editAuthorSelect').val($(this).data('author')).prop('selected', true);
            $('#oldAuthor').val($(this).data('author'));
            $('#editBookCategory').val($(this).data('category')).prop('selected', true);
            $('#bookId').val($(this).data('id'));
          })
        },
      });
      // getting the categories
      $.ajax({
        url: ".././CRUD's/categories.php",
        success: function (response) {
          $.each(response, function (index, value) {
            $('#category, #editBookCategory').append(`<option value="${value.category_id}">${value.name}</option>`);
            $('#categoriesRow table').append(`<tr data-id="${value.category_id}">
                                              <td>${value.category_id}</td>
                                              <td class="text-capitalize">${value.name}</td>
                                              <td>
                                                <button class="btn btn-sm btn-warning m-1 editCategoryBtns" data-type="category" data-id="${value.category_id}">Edit</button>
                                                <button class="btn btn-sm btn-danger m-1 deleteCategoryBtns" data-type="category" data-id="${value.category_id}">Delete</button>
                                              </td>
                                            </td>`);
          })
          $('.deleteCategoryBtns').click(function () {
            const clickedButton = $(this);
            $.ajax({
              url: ".././CRUD's/deleteItem.php",
              type: "POST",
              data: {
                id: clickedButton.data("id"),
                item: clickedButton.data("type"),
              },
              success: function (response) {
                $(`#categoriesRow table tr[data-id="${clickedButton.data('id')}"]`).remove();
                $('#deleteCategoryMsg').html(`<p class="alert alert-danger text-center">${JSON.parse(response).message}</p>`);
                $('#deleteCategoryMsg').fadeIn();
                setTimeout(function () {
                  $('#deleteCategoryMsg').fadeOut();
                }, 2000)
              },
            });
          });
          $('.editCategoryBtns').click(function () {
            $('#addCategory').hide();
            $('#editCategory').show();
            let row = $(this).data('id');
            $('#editName').val($(`#categoriesRow table tr[data-id="${row}"] td:nth-child(2)`).text());
            $('#categoryId').val($(`#categoriesRow table tr[data-id="${row}"] td:nth-child(1)`).text());
          });
        },
      })
      // getting the authors
      $.ajax({
        url: ".././CRUD's/authors.php",
        success: function (response) {
          $.each(response, function (index, value) {
            $('#author,#editAuthorSelect').append(`<option value="${value.author_id}">${value.first_name} ${value.last_name}</option>`);
            $('#authorsRow table').append(`<tr data-id="${value.author_id}">
                                              <td>${value.author_id}</td>
                                              <td class="text-capitalize">${value.first_name}</td>
                                              <td class="text-capitalize">${value.last_name}</td>
                                              <td>${value.short_bio}</td>
                                              <td>
                                                <button class="btn btn-sm btn-warning m-1 editAuthorBtns" data-type="author" data-id="${value.author_id}">Edit</button>
                                                <button class="btn btn-sm btn-danger m-1 deleteAuthorBtns" data-type="author" data-id="${value.author_id}">Delete</button>
                                              </td>
                                            </td>`);
          })
          $('.deleteAuthorBtns').click(function () {
            const clickedButton = $(this);
            $.ajax({
              url: "deleteItem.php",
              type: "POST",
              data: {
                id: clickedButton.data("id"),
                item: clickedButton.data("type"),
              },
              success: function (response) {
                $(`#authorsRow table tr[data-id="${clickedButton.data('id')}"]`).remove();
                $('#deleteAuthorMsg').html(`<p class="alert alert-danger text-center">${JSON.parse(response).message}</p>`);
                $('#deleteAuthorMsg').fadeIn();
                setTimeout(function () {
                  $('#deleteAuthorMsg').fadeOut();
                }, 2000)
              }
            });
          });
          $('.editAuthorBtns').click(function () {
            $('#addAuthor').hide();
            $('#editAuthor').show();
            let row = $(this).data('id');
            $('#editFirstName').val($(`#authorsRow table tr[data-id="${row}"] td:nth-child(2)`).text());
            $('#oldFirstName').val($(`#authorsRow table tr[data-id="${row}"] td:nth-child(2)`).text());
            $('#editLastName').val($(`#authorsRow table tr[data-id="${row}"] td:nth-child(3)`).text());
            $('#oldLastName').val($(`#authorsRow table tr[data-id="${row}"] td:nth-child(3)`).text());
            $('#editShortBio').val($(`#authorsRow table tr[data-id="${row}"] td:nth-child(4)`).text());
            $('#authorId').val($(`#authorsRow table tr[data-id="${row}"] td:nth-child(1)`).text());
          });

        },
      })
      // getting the comments
      $.ajax({
        url: ".././CRUD's/comments.php",
        success: function (response) {
          $.each(response, function (index, value) {
            if (value.is_approved == 0) {
              $('#commentsRow').append(`<div class="card border-secondary mb-3" data-id="${value.comment_id}">
                                        <div class="card-header border-secondary">${value.comment_id}. ${value.first_name} ${value.last_name} for ${value.title}</div>
                                        <div class="card-body">
                                          <p class="card-text">${value.content}</p>
                                        </div>
                                        <div class="card-footer border-secondary">
                                        <button class="btn btn-success approveBtns" data-id="${value.comment_id}">Approve</button>
                                        <button class="btn btn-danger rejectBtns" data-id="${value.comment_id}">Reject</button>
                                        </div>
                                      </div>`);
            } else if (value.is_approved == 2) {
              $('#rejectedCommentsRow').append(`<div class="card border-secondary mb-3">
                                        <div class="card-header border-secondary">${value.comment_id}. ${value.first_name} ${value.last_name} for ${value.title}</div>
                                        <div class="card-body">
                                          <p class="card-text">${value.content}</p>
                                        </div>
                                        <div class="card-footer border-secondary">
                                        <button class="btn btn-success approveBtns" data-id="${value.comment_id}">Approve</button>
                                        </div>
                                      </div>`);
            }
          })
          $('.rejectBtns').click(function () {
            const clickedButton = $(this).data('id');
            $.ajax({
              url: ".././CRUD's/commentsApproval.php",
              type: "POST",
              data: {
                id: $(this).data('id'),
                approve: 2,
              },
              success: function (response) {
                $('#rejectedCommentsRow').append($(`#commentsRow div[data-id="${clickedButton}"]`));
                $(`#commentsRow div[data-id="${clickedButton}"]`).remove();
                $(`.rejectBtns[data-id="${clickedButton}"]`).remove()
                $('#commentMsg').html(`<p class="alert alert-danger text-center w-75 mx-auto">${JSON.parse(response).message}</p>`);
                $('#commentMsg').fadeIn();
                setTimeout(function () {
                  $('#commentMsg').fadeOut();
                }, 2000)
              }
            })
          });
          $('.approveBtns').click(function () {
            const clickedButton = $(this).data('id');
            $.ajax({
              url: ".././CRUD's/commentsApproval.php",
              type: "POST",
              data: {
                id: $(this).data('id'),
                approve: 1,
              },
              success: function (response) {
                $(`#commentsRow div[data-id="${clickedButton}"],#rejectedCommentsRow div[data-id="${clickedButton}"]`).remove();
                $('#commentMsg').html(`<p class="alert alert-success text-center w-75 mx-auto">${JSON.parse(response).message}</p>`);
                $('#commentMsg').fadeIn();
                setTimeout(function () {
                  $('#commentMsg').fadeOut();
                }, 2000)
              }
            })
          })
        }
      })
      if (location.search.includes("author")) {
        $('.sections').hide();
        $('#authorsSection').show();
        $('#books').prop('checked', false);
        $('#authors').prop("checked");
        history.pushState({}, document.title, location.pathname);
      } else if (location.search.includes("category")) {
        $('.sections').hide();
        $('#categoriesSection').show();
        $('#books').prop('checked', false);
        $('#categories').prop("checked");
        history.pushState({}, document.title, location.pathname);
      }
      if ($('.alert')) {
        setTimeout(() => {
          $('.alert').fadeOut();
          history.pushState({}, document.title, location.pathname);
        }, 2000);
      }
    });

    //writing the user info in userlog
    $("#userLog p").html(`${localStorage.getItem("firstName")} ${localStorage.getItem("lastName")}`);

    //additional functions and eventlisteners
    function logOut() {
      localStorage.clear();
      history.pushState({}, document.title, window.location.pathname);
      location.reload();
      window.location.href = "dashboard.html";
    }
    $(".btn-check").on("change", function () {
      if ($(this).prop("checked")) {
        $(".sections").hide();
        $(`#${this.id}Section`).show();
      }
    });
    $('#cancelBtn').click(function () {
      $('#editBook').hide();
      $('#addBook').show();
    })
    $("#addAuthor form").submit(function (e) {
      if ($("#shortBio").val().length < 20) {
        e.preventDefault();
        $("#bioMsg").html(
          '<p class="text-danger">Please enter biography with minimal 20 characters</p>'
        );
        $("#shortBio").removeClass("mb-3");
      }
    });
    $('#cancelEditAuthor').click(function () {
      $('#editAuthor').hide();
      $('#addAuthor').show();
    });
    $("#editAuthor form").submit(function (e) {
      if ($("#editShortBio").val().length < 20) {
        e.preventDefault();
        $("#editBioMsg").html(
          '<p class="text-danger">Please enter biography with minimal 20 characters</p>'
        );
        $("#shortBio").removeClass("mb-3");
      }
    });
    $('#cancelEditCategory').click(function () {
      $('#editCategory').hide();
      $('#addCategory').show();
    })
  </script>
</body>
</html>