<?php use_helper('Javascript') ?>
<?php if ($usageType == QubitTerm::MASTER_ID): ?>
  <?php if ($link == null): ?>
  <?php echo image_tag($representation->getFullPath()); ?>
  <?php else: ?>
  <?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
  <?php endif; ?>
<?php elseif ($usageType == QubitTerm::REFERENCE_ID): ?>
  <?php if ($showFlashPlayer): ?>
    <?php echo javascript_tag(<<<EOF
      // select all link tags with "flowplayer" class and "audio-enable" them.
      $(function() { 
          $('a.flowplayer').flashembed('$pathToFlowPlayer', {
            config:
            {
              clip: {
                autoPlay: false,
                autoBuffering: true,
                url: '$representationFullPath'
              },
              plugins: {
                controls: { // This plugin is automatically loaded by flowplayer

                  // TODO: i18n tooltips
                  tooltips: {
                    // buttons: false,
                    // play: '',
                    // pause: '',
                    // mute: '',
                    // unmute: '',
                    // stop: '',
                    // fullscreen: '',
                    // fullscreenExit: '',
                    // next: '',
                    // previous: '',
                    // scrubber: true
                    // volume: true
                  },

                  // Coloring properties
                  backgroundColor: '#006699',
                  backgroundGradient: 'low',
                  timeColor: '#ffffff',
                  durationColor: '#000000',
                  progressColor: '#000000',
                  progressGradient: 'low',
                  bufferColor: '#ffffff',
                  bufferGradient: 'low',
                  sliderColor: '#999999',
                  sliderGradient: 'low',
                  buttonColor: '#ff9d3c',
                  buttonOverColor: '#000000',
                  volumeSliderColor: '#999999',
                  volumeSliderGradient: 'low',
                  timeBgColor: '#006699',

                  // Position, dimensions, ...,
                  height: '24px',

                  // Visibility properties and buttons
                  autohide: 'never',
                  all: true,
                  playlist: false
                }
              }
            }
          });
      });
EOF
    ) ?>
    <a class="flowplayer flowplayerVideo" href="<?php echo public_path($representation->getFullPath()) ?>">
      
    </a>
  <?php else: ?>
    <div style="text-align: center">
      <?php echo image_tag($representation->getFullPath(), array('style' => 'border: #999 1px solid')) ?>
    </div>
  <?php endif;?>
  
  <!-- link to download master -->
  <?php if ($link != null): ?>
  <?php echo link_to(__('download movie'),$link) ?>
  <?php endif; ?>
<?php elseif ($usageType == QubitTerm::THUMBNAIL_ID): ?>
  <?php if ($iconOnly): ?>
    <?php if ($link == null): ?>
      <?php echo image_tag($representation->getFullPath()); ?>
    <?php else: ?>
      <?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
    <?php endif; ?>
  <?php else: ?>
  <div class="digitalObject">
    <div class="digitalObjectRep">
      <?php if ($link == null): ?>
      <?php echo image_tag($representation->getFullPath()); ?>
      <?php else: ?>
      <?php echo link_to(image_tag($representation->getFullPath()), $link); ?>
      <?php endif; ?>
    </div>
    <div class="digitalObjectDesc">
      <?php echo string_wrap($digitalObject->getName(), 18); ?>
    </div>
  </div>
  <?php endif; ?>
<?php endif; ?>
