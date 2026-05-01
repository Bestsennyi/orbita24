<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }

  gtag("consent", "default", {
    ad_storage: "denied",
    ad_user_data: "denied",
    ad_personalization: "denied",
    analytics_storage: "denied",
    wait_for_update: 500,
  });

  window.orbita24UpdateConsent = function () {
    const consent = window.Cookiebot && window.Cookiebot.consent ? window.Cookiebot.consent : {};
    const analyticsStorage = consent.statistics ? "granted" : "denied";
    const adStorage = consent.marketing ? "granted" : "denied";

    gtag("consent", "update", {
      ad_storage: adStorage,
      ad_user_data: adStorage,
      ad_personalization: adStorage,
      analytics_storage: analyticsStorage,
    });

    if (analyticsStorage === "granted" && typeof window.orbita24LoadGtm === "function") {
      window.orbita24LoadGtm();
    }
  };

  window.orbita24HandleCookiebotConsent = function () {
    window.orbita24UpdateConsent();
    window.setTimeout(window.orbita24UpdateConsent, 250);
  };

  window.CookiebotCallback_OnLoad = window.orbita24HandleCookiebotConsent;
  window.CookiebotCallback_OnAccept = window.orbita24HandleCookiebotConsent;
  window.CookiebotCallback_OnDecline = window.orbita24UpdateConsent;
  window.addEventListener("CookiebotOnConsentReady", window.orbita24HandleCookiebotConsent);
  window.addEventListener("CookiebotOnAccept", window.orbita24HandleCookiebotConsent);
  window.addEventListener("CookiebotOnDecline", window.orbita24UpdateConsent);
</script>
<script
  id="Cookiebot"
  src="https://consent.cookiebot.com/uc.js"
  data-cbid="2442c9f2-b102-489d-b183-906d466fc319"
  data-culture="DE"
  type="text/javascript"
  async
></script>
