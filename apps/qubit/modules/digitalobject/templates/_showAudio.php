<?php use_helper('Javascript') ?>
<?php echo javascript_tag(<<<EOF
  // select all link tags with "flowplayer" class and "audio-enable" them.
  $(function() { 
      $('a.flowplayer').flashembed('$pathToFlowPlayer', {
        config:
        {
          clip: {
            autoPlay: false,
            autoBuffering: false,
            url: '$link'
          },
          plugins: {
            audio: {
              url: '$pathToFlowPlayerAudioPlugin'
            },
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
              playlist: false,
              fullscreen: false
            }
          }
        }
      });
  });
EOF
) ?>

<a class="flowplayer flowplayerAudio" href="<?php echo $link ?>"></a>

<!-- link to download master -->
<?php if ($link != null): ?>
  <?php echo link_to(__('download audio'),$link) ?>
<?php endif; ?>
