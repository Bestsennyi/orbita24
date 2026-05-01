<script>
  const ORBITA24_GTM_ID = "GTM-5HL9LFK4";

  window.orbita24LoadGtm = function () {
    if (window.orbita24GtmLoaded) return;
    window.orbita24GtmLoaded = true;

    (function (w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != "dataLayer" ? "&l=" + l : "";
      j.async = true;
      j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, "script", "dataLayer", ORBITA24_GTM_ID);
  };
</script>
<script type="text/plain" data-cookieconsent="statistics">
  window.orbita24LoadGtm();
</script>
