<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Text to Speech</title>
  <!-- Style -->
  <link rel="stylesheet" href="assets/css/formstyle.css" />

</head>

<body>
  <div id="waveform" style="height: 20px;">

  </div>

  <script src="https://unpkg.com/wavesurfer.js"></script>
  <script>
    var wavesurfer = WaveSurfer.create({
      container: '#waveform',
      waveColor: 'violet',
      progressColor: 'purple',
      barWidth: 2,
      barHeight: 0.5, // the height of the wave
      barGap: null // t
    });
    wavesurfer.load("assets/audio/04-07-2022_12_46_06.wav");
  </script>
</body>


</html>