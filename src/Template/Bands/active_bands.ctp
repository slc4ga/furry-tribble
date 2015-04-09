<style>
table th, td {
    text-align: center;
}
</style>
<div class="row">
	<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="alert alert-info" role="alert">
					<strong> Welcome to the bands site!</strong> 
					Our github repo is a Star Trek reference, according to Dean Groves.
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Most Active Bands</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-md-12 col-sm-12">
                <?php if (sizeof($bands) > 0) : ?>
                    <table class="table table-striped"> 
                        <thead>
                            <th>Band</th>
                            <th># of Comments</th>
                            <th>Comments in last <?= $days ?> Days</th>
                            <th>Last Comment</th>
                        </thead>
                        <tbody>
                            <?php foreach ($bands as $band): ?>
                                <tr id="<?= $band['id']?>">
                                    <td><?= $this->Html->link("Band " . $band['id'], ['action' => 'view', $band['id']]); ?></td>
                                    <td><?= $band['comments'] ?></td>
                                    <td><?= $band['comments_in_days'] ?></td>
                                    <td><?php if(isset($band['last_comment'])) {
                                                echo date('n/j/Y g:i A',strtotime($band['last_comment']['timestamp'])); 
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h4>No bands have been entered yet!</h4>
                <?php endif; ?>
            </div>
        </div>
	</div>
</div>
