# Linux - Install Viber

To install Viber run the following commands:

```
wget http://download.cdn.viber.com/cdn/desktop/Linux/viber.deb
sudo dpkg -i viber.deb
```

If the installation fails, we need to install the dependencies:

```
sudo apt update
sudo apt install gstreamer1.0-plugins-good gstreamer1.0-plugins-ugly libcdio19 libopencore-amrnb0 libopencore-amrwb0 libsidplay1v5 gstreamer1.0-pulseaudio gstreamer1.0-libav libavfilter8 libbs2b0 libflite1 libpocketsphinx3 librubberband2 libsphinxbase3 libvidstab1.1 libzimg2 liblapack3 libblas3 libgfortran5 libgstreamer-plugins-bad1.0-0 libxslt1.1 -y
```
