<?php // index.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>GYM MANAGEMENT | Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
  <style>
    :root {
      --bg-color: #ffffff;
      --text-color: #000000;
      --card-color: #f9f9f9;
      --primary: #ff4c60;
    }

    body.dark-mode {
      --bg-color: #121212;
      --text-color: #f1f1f1;
      --card-color: #1e1e1e;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
      transition: background 0.3s, color 0.3s;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      font-family: 'Segoe UI', sans-serif;
    }

    nav {
      background: #222;
      color: white;
      padding: 1em 2em;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    nav a {
      color: white;
      margin: 0 1em;
      text-decoration: none;
    }

    .btn {
      background: var(--primary);
      border: none;
      color: #fff;
      padding: 0.5em 1em;
      border-radius: 5px;
      margin-left: 0.5em;
      cursor: pointer;
    }

    .btn:hover {
      background: #e13c50;
    }

    .dark-toggle {
      background: #444;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 0.5em 1em;
      cursor: pointer;
    }

    .hero-slider {
      position: relative;
      height: 90vh;
      overflow: hidden;
    }

    .hero-slide {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1.5s ease-in-out;
      animation: fadeSlider 15s infinite;
    }

    .hero-slide:nth-child(1) { animation-delay: 0s; }
    .hero-slide:nth-child(2) { animation-delay: 5s; }
    .hero-slide:nth-child(3) { animation-delay: 10s; }

    @keyframes fadeSlider {
      0%, 100% { opacity: 0; }
      10%, 30% { opacity: 1; }
      40%, 100% { opacity: 0; }
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: #fff;
      z-index: 10;
      padding: 2rem;
      background: rgba(0, 0, 0, 0.4);
      border-radius: 12px;
    }

    .hero-content h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .hero-content h1 span {
      color: #ff4c60;
    }

    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }

    .hero-buttons {
      display: flex;
      gap: 1rem;
      justify-content: center;
    }

    .btn-primary,
    .btn-secondary {
      padding: 0.8rem 1.6rem;
      border: none;
      border-radius: 30px;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .btn-primary {
      background-color: #ff4c60;
      color: white;
    }

    .btn-primary:hover {
      background-color: #e63850;
    }

    .btn-secondary {
      background-color: transparent;
      border: 2px solid #fff;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #fff;
      color: #000;
    }

    .section {
      padding: 4em 2em;
      text-align: center;
    }

    .plans, .trainers, .features, .reviews {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2em;
    }

    .card {
      background: var(--card-color);
      padding: 1.5em;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-8px);
    }

    .trainers img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 0.5em;
    }

    .features i {
      font-size: 2em;
      margin-bottom: 0.5em;
      color: var(--primary);
    }

    footer {
      background: #111;
      color: #eee;
      padding: 2em;
      text-align: center;
    }

    .contact-form {
      max-width: 500px;
      margin: auto;
    }

    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 0.8em;
      margin-bottom: 1em;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: var(--card-color);
      color: var(--text-color);
    }
    .trainers img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 0.5em;
}

.stars {
  color: gold;
  margin-top: 0.5em;
  font-size: 1.2em;
}
.reviews {
  display: flex;
  justify-content: center;
  gap: 2em;
  flex-wrap: wrap;
}

.reviews .card {
  background-color: #fff;
  border-radius: 1em;
  padding: 1.5em;
  max-width: 300px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
  text-align: center;
  transition: transform 0.3s ease;
}

.reviews .card:hover {
  transform: scale(1.03);
}

.reviews img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  margin-bottom: 0.5em;
  object-fit: cover;
}

.reviews .stars {
  color: gold;
  margin: 0.5em 0;
  font-size: 1.2em;
}
@media (prefers-color-scheme: dark) {
  #reviews {
    background-color: #111; /* Optional: dark background */
    color: #fff;
  }
  #reviews .card {
    background-color: #222;
    color: #fff;
    border: 1px solid #444;
  }
  #reviews .stars {
    color: #ffd700; /* Gold stars */
  }
}
/* Default Light Mode */
body {
  background: #fff;
  color: #222;
  transition: background 0.3s, color 0.3s;
}

.reviews .card {
  background: #f9f9f9;
  color: #333;
  padding: 1rem;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: background 0.3s, color 0.3s;
}

/* Dark Mode Styles */
body.dark-mode {
  background: #121212;
  color: #f1f1f1;
}

body.dark-mode .reviews .card {
  background: #1e1e1e;
  color: #f1f1f1;
  box-shadow: 0 4px 8px rgba(255,255,255,0.1);
}

body.dark-mode .reviews .card h4,
body.dark-mode .reviews .card p,
body.dark-mode .stars {
  color: #f1f1f1;
}

/* Optional: Dark mode for contact section */
body.dark-mode #contact {
  background: #1e1e1e;
}

body.dark-mode input,
body.dark-mode textarea {
  background: #2a2a2a;
  color: #fff;
  border: 1px solid #444;
}

body.dark-mode .btn {
  background-color: #333;
  color: #fff;
  border: none;
}



  </style>
</head>
<body>

<!-- Navigation -->
<nav>
  <div><strong>GYM MANAGEMENT</strong></div>
  <div>
    <a href="#plans">Plans</a>
    <a href="#trainers">Trainers</a>
    <a href="#features">Features</a>
    <a href="#contact">Contact</a>
    <button class="dark-toggle" onclick="toggleDarkMode()">🌙</button>
    <a href="login.php" class="btn">Login</a>
    <a href="signup.php" class="btn">Sign Up</a>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero-slider">
  <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z3ltJTIwbWFufGVufDB8fDB8fHww"></div>
  <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1546483875-ad9014c88eba?w=1200');"></div>
  <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1518611012118-696072aa579a?w=1200');"></div>
  <div class="hero-content">
    <h1>Welcome to <span>GymPro</span></h1>
    <p>Your fitness journey starts here. Train smarter. Live better.</p>
    <div class="hero-buttons">
      <a href="#plans" class="btn-primary">View Plans</a>
      <a href="signup.php" class="btn-secondary">Join Now</a>
    </div>
  </div>
</div>

<!-- Membership Plans -->
<section class="section" id="plans">
  <h2>Our Membership Plans</h2>
  <p>Choose a plan that fits your goals and start your transformation today!</p>
  
  <div class="plans" data-aos="fade-up">
    <div class="card">
      <h3 style="color:#ff4c60;">Basic</h3>
      <h4>₹999/month</h4>
      <ul style="list-style:none;padding:0;margin:1em 0;">
        <li>✔ Gym Access</li>
        <li>✔ Group Classes</li>
        <li>✖ Trainer</li>
        <li>✖ Diet Plan</li>
      </ul>
      <button class="btn">Join Now</button>
    </div>
    <div class="card" style="border:2px solid #ff4c60;">
      <h3 style="color:#ff4c60;">Standard</h3>
      <h4>₹1999/month</h4>
      <ul style="list-style:none;padding:0;margin:1em 0;">
        <li>✔ Gym Access</li>
        <li>✔ Group Classes</li>
        <li>✔ Trainer</li>
        <li>✖ Diet Plan</li>
      </ul>
      <button class="btn">Join Now</button>
    </div>
    <div class="card">
      <h3 style="color:#ff4c60;">Premium</h3>
      <h4>₹2999/month</h4>
      <ul style="list-style:none;padding:0;margin:1em 0;">
        <li>✔ All Access</li>
        <li>✔ Personal Trainer</li>
        <li>✔ Diet Plan</li>
        <li>✔ Fitness Analytics</li>
      </ul>
      <button class="btn">Join Now</button>
    </div>
  </div>
</section>

<!-- Trainer Profiles -->
<!-- Trainer Profiles -->
<section class="section" id="trainers">
  <h2>Meet Our Trainers</h2>
  <p>Certified professionals to guide your fitness journey</p>
  <div class="trainers" data-aos="fade-up">
    <div class="card">
      <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Trainer 1" />
      <h4>Rahul Sharma</h4>
      <p>Strength Coach</p>
      <div class="stars">
        ★★★★☆
      </div>
    </div>
    <div class="card">
      <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Trainer 2" />
      <h4>Pooja Mehta</h4>
      <p>Yoga Expert</p>
      <div class="stars">
        ★★★★★
      </div>
    </div>
    <div class="card">
      <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Trainer 3" />
      <h4>Arjun Rao</h4>
      <p>HIIT Specialist</p>
      <div class="stars">
        ★★★★☆
      </div>
    </div>
  </div>
</section>


<!-- Features -->
<section class="section" id="features">
  <h2>Why Choose GymPro?</h2>
  <div class="features" data-aos="fade-up">
    <div class="card">
      <i class="fas fa-dumbbell"></i>
      <h3>Modern Equipment</h3>
      <p>State-of-the-art machines and tools for all fitness levels.</p>
    </div>
    <div class="card">
      <i class="fas fa-heartbeat"></i>
      <h3>Health Monitoring</h3>
      <p>Track progress and monitor performance in real-time.</p>
    </div>
    <div class="card">
      <i class="fas fa-users"></i>
      <h3>Community</h3>
      <p>Be part of a motivating and uplifting fitness family.</p>
    </div>
  </div>
</section>

<!-- User Reviews Section -->
<section class="section" id="reviews">
  <h2>What Our Members Say</h2>
  <p>Real experiences from our fitness community</p>
  <div class="reviews" data-aos="fade-up">
    <div class="card">
      <img src="https://randomuser.me/api/portraits/women/81.jpg" alt="User 1">
      <h4>Neha Verma</h4>
      <div class="stars">★★★★★</div>
      <p>"This gym changed my life! The trainers are professional and the environment is amazing."</p>
    </div>
    <div class="card">
      <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="User 2">
      <h4>Ravi Singh</h4>
      <div class="stars">★★★★☆</div>
      <p>"Great workout plans and very clean facility. I feel motivated every day!"</p>
    </div>
    <div class="card">
      <img src="https://randomuser.me/api/portraits/women/50.jpg" alt="User 3">
      <h4>Simran Kaur</h4>
      <div class="stars">★★★★★</div>
      <p>"The personalized diet plans really helped me reach my goals. Highly recommended!"</p>
    </div>
  </div>
</section>


<!-- Contact -->
<section class="section" id="contact">
  <h2>Contact Us</h2>
  <div class="contact-form" data-aos="fade-up">
    <form action="contact.php" method="post">
      <input type="text" name="name" placeholder="Your Name" required />
      <input type="email" name="email" placeholder="Your Email" required />
      <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
      <button class="btn" type="submit">Send Message</button>
    </form>
  </div>
</section>



<!-- Footer -->
<footer>
  <p>&copy; 2025 GymPro. All rights reserved.</p>
</footer>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();

  function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
  }
</script>

</body>
</html>
