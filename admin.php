<?php
// Author: hana
// Task: admin dashboard with login protection

session_start();

include 'includes/header.php';
//  PAGE PROTECTION
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
include 'database/db.php';

/* ADD PRODUCT */
if (isset($_POST['add'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];

    // VALIDATION (improved)
    if (empty($name) || empty($description) || empty($price)) {
        echo "Please fill all required fields";
    } else {

        // IMAGE CHECK
        $image = "";
        if (!empty($_FILES['image']['name'])) {

            $image = time() . "_" . $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];

            //  EXTENSION CHECK
            $allowed = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                echo "Invalid image type";
                exit();
            }

            move_uploaded_file($tmp, "images/products/" . $image);
        }

        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $description, $price, $image);

        if ($stmt->execute()) {
            echo "Product added successfully";
        } else {
            echo "Error adding product";
        }
    }
}

/* DELETE PRODUCT */
if (isset($_GET['delete'])) {

    $product_id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    echo "Product deleted successfully";
}

/* UPDATE PRODUCT */
if (isset($_POST['update'])) {

    $product_id = $_POST['id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {

        $image = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            echo "Invalid image type";
            exit();
        }

        move_uploaded_file($tmp, "images/products/" . $image);

        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("ssisi", $name, $description, $price, $image, $product_id);

    } else {

        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("ssii", $name, $description, $price, $product_id);
    }

    if ($stmt->execute()) {
        echo "Product updated successfully";
    } else {
        echo "Update failed";
    }
}

/* SEARCH */
$search = "";

if (isset($_GET['search'])) {

    $search = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    $result = $conn->query("SELECT * FROM products");
}

/* EDIT */
$editProduct = null;

if (isset($_GET['edit'])) {

    $product_id = $_GET['edit'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $editProduct = $stmt->get_result()->fetch_assoc();
}
?>

<?php include 'includes/header.php'; ?>

<div class="container">

<!-- ADMIN -->
<h2>Welcome <?php echo htmlspecialchars($_SESSION["admin_username"]); ?></h2>

<a class="logout" href="logout.php">Logout</a>

<hr>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search product">
    <button>Search</button>
</form>

<hr>

<!-- ADD / EDIT -->
<?php if ($editProduct == null) { ?>

<h3>Add Product</h3>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="text" name="description" placeholder="Description"><br><br>
    <input type="number" name="price" placeholder="Price"><br><br>
    <input type="file" name="image"><br><br>
    <button name="add">Add</button>
</form>

<?php } else { ?>

<h3>Edit Product</h3>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $editProduct['id']; ?>">

    <input type="text" name="name" value="<?php echo htmlspecialchars($editProduct['name']); ?>"><br><br>
    <input type="text" name="description" value="<?php echo htmlspecialchars($editProduct['description']); ?>"><br><br>
    <input type="number" name="price" value="<?php echo $editProduct['price']; ?>"><br><br>
    <input type="file" name="image"><br><br>

    <button name="update">Update</button>
</form>

<a href="admin.php">Cancel</a>

<?php } ?>

<hr>

<!-- PRODUCTS -->
<table border="1" cellpadding="10">
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
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['description']); ?></td>
    <td><?php echo $row['price']; ?></td>

    <td>
        <img src="images/products/<?php echo $row['image']; ?>" width="60">
    </td>

    <td>
        <a href="admin.php?edit=<?php echo $row['id']; ?>">Edit</a> |
        <a onclick="return confirm('Are you sure?')" href="admin.php?delete=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

<?php include 'includes/footer.php'; ?>