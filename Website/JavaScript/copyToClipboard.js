/*
 * Filename: copyToClipboard.js
 * Author: Albertus Cilliers
 * Description: Copies provided text to clipboard.
*/

function copyToClipboard(text) {
  navigator.clipboard.writeText(text);
  
  // DIsplay the copied text
  // alert("Copied the text: " + text);
}