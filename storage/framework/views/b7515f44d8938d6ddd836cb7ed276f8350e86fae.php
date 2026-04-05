<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Game Type</th>
      <th scope="col">Market</th>
      <th scope="col">Bat Number</th>
      <th scope="col">Amount</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1;?>
    <?php $i = 1; $total_tr_value = 0; ?> 
    <?php $__currentLoopData = $total_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <th scope="row"><?php echo e($i); ?></th>
      <?php
      if($vs->game_type == 8)
      {
        $game_type = 'Jodi';
      }elseif($vs->game_type == 9)
      {
        $game_type = 'Andar';
      }elseif($vs->game_type == 10)
      {
        $game_type = 'Bahar';
      }
      ?>
      <td><?php echo e(is_null($vs->user_data)?'NA':$vs->user_data->FullName); ?></td>
      <td><?php echo e(is_null($vs->user_data)?'NA':$vs->user_data->mob); ?></td>
      <td><?php echo e($game_type); ?></td>
      <td><?php echo e($vs->table_id); ?></td>
      <td><?php echo e($vs->pred_num); ?></td>
      <td><?php echo e($vs->tr_value); ?></td> 
      <td><?php echo e(date('d-m-Y h:i:s A',strtotime($vs->created_at))); ?></td>
      <?php 
  // Add the tr_value to the total
  $total_tr_value  += $vs->tr_value;
  ?>
    </tr>

   
    <?php $i++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- <tr>
  <td colspan="6" style="text-align:right;"><strong>Total</strong></td>
  <td><strong><?php echo e(@$total_tr_value); ?></strong></td>
  <td></td>
</tr> -->
  </tbody>
</table><?php /**PATH /home/admin.playonlineds.net/public_html/resources/views/administrator/gameload/batlist.blade.php ENDPATH**/ ?>