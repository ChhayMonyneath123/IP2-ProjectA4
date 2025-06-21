import { KHQR, CURRENCY, COUNTRY, TAG } from "ts-khqr";
export async function getBakongQR(amountInKHR: number) {

  const result = KHQR.generate({
    tag: TAG.INDIVIDUAL,
    accountID: "khem_soksombath@trmc",
    merchantName: "La Libre",
    merchantID: "012345678",
    acquiringBank: "Dev Bank",
    merchantCity: "Phnom Penh",
    currency: CURRENCY.KHR,
    amount: amountInKHR,
    countryCode: COUNTRY.KH,
    additionalData: {
      mobileNumber: "85512345678",
      billNumber: "INV-2022-12-25",
      storeLabel: "Ishin Shop",
      terminalLabel: "012345",
      purposeOfTransaction: "Payment",
    },
    languageData: {
      languagePreference: "ZH",
      merchantNameAlternateLanguage: "文山",
      merchantCityAlternateLanguage: "金边",
    },
    upiMerchantAccount: "",
  });

  return result.data;

}

// export const sendTelegramMessage = async (message: string) => {
//   const telegramApiUrl = `https://api.telegram.org/bot${import.meta.env.VITE_TELEGRAM_BOT_TOKEN}/sendMessage?chat_id=${import.meta.env.VITE_TELEGRAM_CHAT_ID}&text=${message}`;
//   console.log(telegramApiUrl);
//   let api = new XMLHttpRequest()
//   api.open("GET", telegramApiUrl, true)
//   api.send()

// };
export const getCurrentDateTime = (): string => {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');

  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
};

// export async function ApplyCoupon(coupon: string) {
//   const accessToken = await getAccessToken();
//   const getCodeUrl = `https://techbox.developimpact.net/o/c/coupons/?filter=code%20eq%20%27${coupon}%27%20and%20qty%20gt%200`
//   const response = await fetch(getCodeUrl, {
//     method: 'GET',
//     headers: {
//       'Content-Type': 'application/json',
//       Authorization: `Bearer ${accessToken}`,
//     },
//   });
//   if (!response.ok) {
//     const errorDetails = await response.json();
//     console.error('Coupon is invalid or already used:', errorDetails);
//     return false;
//   }
//   const data = await response.json();

//   if (data.items.length <= 0) {
//     return false;
//   }

//   if(response.ok){
//     return {status: "success", percentage: data.items[0].percentage, id: data.items[0].id, qty: data.items[0].qty}
//   }else{
//     console.warn("Invalid or Unknown Coupon code")
//   }
// }

// export async function updateCouponQTY (couponID: number, qty: number){
//   const accessToken = await getAccessToken();
//   const patchUrl = `https://techbox.developimpact.net/o/c/coupons/${couponID}`

//   const patch = await fetch(patchUrl, {
//     method: 'PATCH',
//     headers: {
//       'Content-Type': 'application/json',
//       Authorization: `Bearer ${accessToken}`,
//     },
//     body: JSON.stringify({
//       "qty": qty - 1,
//     })
//   });

//   if(patch.ok){
//     return {status: "success"}
//   }else{
//     console.warn("Invalid or Unknown Coupon code")
//   }
// }