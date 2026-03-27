<?php
// Author: hana
// // Task: admin dashboard with login protection (add products, Edit , delete , search ,display product)
session_start();

// Page protection
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
include 'database/db.php';

/* ADD PRODUCT */
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Upload the picture
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "images/products/" . $image);

    mysqli_query($conn, "INSERT INTO products (name, description, price, image)
    VALUES ('$name', '$description', '$price', '$image')");
}

/* DELETE PRODUCT */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

/* UPDATE PRODUCT */
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    mysqli_query($conn, "UPDATE products SET 
        name='$name',
        description='$description',
        price='$price'
        WHERE id=$id
    ");
}

/* SEARCH */
$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM products";
}

$result = mysqli_query($conn, $sql);

/* EDIT DATA */
$editProduct = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $editProduct = mysqli_fetch_assoc($res);
}
?>

<?php include 'includes/header.php'; ?>

<div class="container">

<h2>Welcome <?php echo $_SESSION["admin_username"]; ?></h2>

<a class="logout" href="logout.php">Logout</a>

<hr>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="search" placeholder="Search product">
    <button>Search</button>
</form>

<hr>

<!-- ADD / EDIT -->
<?php if ($editProduct == null) { ?>

<h3>Add Product</h3>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="text" name="description" placeholder="Description"><br><br>
    <input type="text" name="price" placeholder="Price"><br><br>
    <input type="file" name="image"><br><br>
    <button name="add">Add</button>
</form>

<?php } else { ?>

<h3>Edit Product</h3>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $editProduct['id']; ?>">

    <input type="text" name="name" value="<?php echo $editProduct['name']; ?>"><br><br>
    <input type="text" name="description" value="<?php echo $editProduct['description']; ?>"><br><br>
    <input type="text" name="price" value="<?php echo $editProduct['price']; ?>"><br><br>

    <button name="update">Update</button>
</form>

<a href="admin.php">Cancel</a>

<?php } ?>

<hr>

<!-- TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Image</th>
    <th>Actions</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td><?php echo $row['price']; ?></td>

    <td>
        <img src="images/products/<?php echo $row['image']; ?>" width="60">
    </td>

    <td>
        <a href="admin.php?edit=<?php echo $row['id']; ?>">Edit</a> |
        <a href="admin.php?delete=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

<?php include 'includes/footer.php'; ?>