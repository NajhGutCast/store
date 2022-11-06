window.onload = async () => {
  sessionStorage.clear();
  try {
    gClipboard.paste(wrapper, (files) => {
      if (files) onProfileUploaded(files[0]);
    }, {
      style: 'transition: 0.125s; opacity: 0.5;'
    })
  } catch {

  } finally {

  }
}

entry_image.onchange = () => {
  let files = entry_image.files;
  if (files.length) {
    onProfileUploaded(files[0]);
  } else {
    sessionStorage.removeItem('image_type');
    sessionStorage.removeItem('image_mini');
    sessionStorage.removeItem('image_full');
  }
}

account_form.onsubmit = onAccountSubmit;
password_form.onsubmit = onPasswordSubmit;
personal_form.onsubmit = onPersonalSubmit;