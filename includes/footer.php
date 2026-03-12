  <footer class="site-footer">
    Copyright &copy; 2003&ndash;<script>document.write(new Date().getFullYear())</script> Garth Wilson &mdash; Visit <a href="https://wilsonmines.com/">Wilson Mines Co.</a> for much more 6502 information
  </footer>

  <div class="lightbox-overlay" id="lightbox" onclick="closeLightbox()">
    <img id="lightbox-img" src="" alt="">
  </div>

  <script>
    document.querySelector('.menu-toggle').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('open');
    });

    function openLightbox(img) {
      var overlay = document.getElementById('lightbox');
      document.getElementById('lightbox-img').src = img.src;
      document.getElementById('lightbox-img').alt = img.alt;
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
      document.getElementById('lightbox').classList.remove('active');
      document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeLightbox();
    });

    document.querySelectorAll('.project-description img, .schematic-view img').forEach(function(img) {
      img.addEventListener('click', function() { openLightbox(this); });
    });
  </script>
</body>
</html>
