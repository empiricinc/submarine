<!-- Calendar files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<!-- Calendar files -->
<section class="secMainWidth">
  <section class="secFormLayout">
    <div class="mainInputBg">
      <div class="row">
        <div class="col-lg-12">
          <div class="tabelHeading">
            <?php if(empty($event_detail)): ?>
            <h3>tentative calendar <span style="text-transform: lowercase;">(six months tentative calendar for trainings)</span> |
              <small>
              <a href="<?= base_url('trainings/events_calendar'); ?>">
                <i class="fa fa-plus"></i> create an event
              </a>
            </small>
            </h3><br>
            <?php else: ?>
            <h3>
              event detail <span style="text-transform: lowercase;">(training info...)</span>
            </h3>
            <?php endif; ?>
            <?php if($success = $this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissable text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="lead"><?php echo $success; ?></p>
              </div>
            <?php endif; ?>
          </div>
            <div id="calendar"></div>
        </div>
        <?php if(!empty($event_detail)): ?>
          <div class="col-lg-8 col-lg-offset-2">
             <div class="panel panel-primary">
               <div class="panel-heading">
                    <h3>
                      <?php echo $event_detail['title']; ?> 
                    </h3>
               </div>
               <div class="panel-body">
                <div class="row">
                  <div class="col-md-3">
                    <strong>Province: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= $event_detail['provName']; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>District: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= $event_detail['cityName']; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>Project: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= $event_detail['compName']; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>Designation: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= $event_detail['designation_name']; ?>
                  </div>  
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>Training Type: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= $event_detail['type']; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>Start Date: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= date('M d, Y', strtotime($event_detail['start_date'])); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>End Date: </strong>
                  </div>
                  <div class="col-md-6">
                    <?= date('M d, Y', strtotime($event_detail['end_date'])); ?>
                  </div>
                </div>
               </div>
               <div class="panel-footer">
                 <a href="javascript: history.go(-1)">Go Back &laquo;</a>
               </div>
             </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script type="text/javascript">
    var events = <?php echo json_encode($data) ?>; 
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
           
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      events    : events
    })
</script>