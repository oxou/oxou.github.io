# Mozilla Firefox - Performance Flags

## Introduction

This post defines a list of properties/flags to be applied to Mozilla Firefox in order to improve performance.

Keep in mind that changing some of these flags may have a negative impact if you are rendering in software mode, therefore consult with the browser manual in regards to these flags.

More information may be found at [kb.mozillazine.org](https://kb.mozillazine.org/About:config_entries).

## Flags

If a flag does not exist then create it with the **Type** specified in the table.

|Property|Type|Value|
|-|-|-|
|gfx.webrender.all|Boolean|true|
|gfx.x11-egl.force-disabled|Boolean|false|
|gfx.x11-egl.force-enabled|Boolean|true|
|ui.prefersReducedMotion|Number|1|
|nglayout.enable_drag_images|Boolean|false|
|gfx.logging.level|Number|0|
|gfx.canvas.accelerated|Boolean|true|
|gfx.offscreencanvas.enabled|Boolean|true|
|gfx.webrender.enabled|Boolean|true|
|gfx.webrender.software.d3d11|Boolean|false|
|layers.acceleration.force-enabled|Boolean|true|
