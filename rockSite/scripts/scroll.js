const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('img-smooth');
    }
  });
});

document.querySelectorAll('.obs').forEach((i) => {
  if (i) {
    observer.observe(i);
  }
});
