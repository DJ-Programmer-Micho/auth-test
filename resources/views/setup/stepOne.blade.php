@php
    $phpOutput = [];
    $phpReturnCode = 0;
    exec('php -v', $phpOutput, $phpReturnCode);
    // Check if Composer is installed
    $composerOutput = [];
    $composerReturnCode = 0;
    exec('composer --version', $composerOutput, $composerReturnCode);
    // Check if Node.js is installed
    $nodeOutput = [];
    $nodeReturnCode = 0;
    exec('node --version', $nodeOutput, $nodeReturnCode);

    return view('setup.setup', compact('phpReturnCode', 'composerReturnCode', 'nodeReturnCode'));
@endphp