<?php
	require_once('../../config/database.php');
	session_start();
	if ($_SESSION['id'] == null){
		header('Location: ../../index.php');
	}
?>
<!DOCTYPE html>
<html>
	<?php include_once('header.html'); ?>
	<div class="upcoming-container">
		<div class="upcoming-images">
				<?php 
				$sql = 'SELECT * FROM gallery';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				$total_records = $stmt->rowCount();
				$records_per_page = 12;
				$page = '';
				if (!isset($_GET['page'])) {
					$page = 1;
				} else {
					if (is_numeric($_GET['page'])) {
						$page = $_GET['page'];
					} else {
						$page = 1;
					}
				}
				$total_pages = ceil($total_records/$records_per_page);
				$start_from = ($page-1) * $records_per_page;
				$sql = "SELECT * FROM gallery ORDER BY id DESC LIMIT $start_from, $records_per_page";
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
			while ($pics = $stmt->fetch()) { ?>
			<a href="comments_page.php?id=<?php echo $pics['id']; ?>">
				<div class="img-wrapper" style="background-image: url(<?php echo "uploads/".$pics['directory']; ?>);">
					<div class="description">
						<div class="desc-content">
								
						</div>
					</div>	
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
	<br />
	<div class="pagination">
		<?php for ($i = 1; $i <= $total_pages; $i++) {
				echo "<a href='home_page.php?page=$i'> $i </a>";
		}?>
	</div>
	<div class="upload_button">
		<a href="upload_image.php">UPLOAD</a>
	</div>
</body>
<script type="text/javascript" src="script.js"></script>
</html>