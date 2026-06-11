const mode = document.getElementById('mode_chk');

mode.addEventListener('change', () => {
  const form = document.getElementById('login_form');

        form.classList.toggle('dark');
        return ;
    }
);
