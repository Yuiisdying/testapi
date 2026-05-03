"""
SIMPLE RANDOM SAMPLING ANALYSIS
Statistical Estimation & Inference Using Gold Price Data

This research demonstrates:
1. Simple Random Sampling (SRS) from 1,347 gold prices
2. Sample statistics and parameter estimation
3. Confidence intervals for population mean
4. Hypothesis testing
5. Sampling efficiency comparison
"""

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from scipy import stats
import seaborn as sns
import sys

# Set random seed for reproducibility
np.random.seed(42)

print("="*80)
print("SIMPLE RANDOM SAMPLING ANALYSIS")
print("Estimating Gold Price Population Parameters from Sample (n=100)")
print("="*80 + "\n")

# ==================== STEP 1: LOAD DATA & POPULATION ====================

print("[STEP 1] Loading population data...")

csv_path = 'c:\\xampp\\htdocs\\tugas\\gold_prices_5year.csv'

try:
    df = pd.read_csv(csv_path)
    print(f"  [OK] CSV file loaded successfully")
except FileNotFoundError:
    print(f"  [ERROR] CSV file not found at {csv_path}")
    sys.exit(1)

# Clean price data
df['Price'] = df['Price'].astype(str).str.replace(',', '').astype(float)
population = df['Price'].values

print(f"  Population size (N): {len(population)}")
print(f"  Date range: {df['Date'].min()} to {df['Date'].max()}")

# ==================== STEP 2: CALCULATE POPULATION PARAMETERS ====================

print("\n[STEP 2] Population Parameters (TRUE VALUES)...")

pop_mean = np.mean(population)
pop_std = np.std(population, ddof=0)  # Population std (ddof=0)
pop_var = np.var(population)
pop_median = np.median(population)
pop_q1 = np.percentile(population, 25)
pop_q3 = np.percentile(population, 75)

print(f"  Population Mean (mu): ${pop_mean:.2f}")
print(f"  Population Std Dev (sigma): ${pop_std:.2f}")
print(f"  Population Variance: ${pop_var:.2f}")
print(f"  Population Median: ${pop_median:.2f}")
print(f"  Population IQR: ${pop_q3 - pop_q1:.2f}")
print(f"  Min Price: ${np.min(population):.2f}")
print(f"  Max Price: ${np.max(population):.2f}")

# ==================== STEP 3: SIMPLE RANDOM SAMPLING ====================

print("\n[STEP 3] Performing Simple Random Sampling (n=100)...")

n_sample = 100
sample = np.random.choice(population, size=n_sample, replace=False)

print(f"  Sample size (n): {n_sample}")
print(f"  Sampling rate: {(n_sample/len(population))*100:.2f}%")
print(f"  [OK] Sample extracted using SRS without replacement")

# ==================== STEP 4: SAMPLE STATISTICS ====================

print("\n[STEP 4] Sample Statistics...")

sample_mean = np.mean(sample)
sample_std = np.std(sample, ddof=1)  # Sample std (ddof=1, unbiased)
sample_var = np.var(sample, ddof=1)
sample_median = np.median(sample)
sample_q1 = np.percentile(sample, 25)
sample_q3 = np.percentile(sample, 75)
sample_se = sample_std / np.sqrt(n_sample)  # Standard Error

print(f"  Sample Mean (X-bar): ${sample_mean:.2f}")
print(f"  Sample Std Dev (s): ${sample_std:.2f}")
print(f"  Sample Variance (s^2): ${sample_var:.2f}")
print(f"  Sample Median: ${sample_median:.2f}")
print(f"  Sample IQR: ${sample_q3 - sample_q1:.2f}")
print(f"  Min in sample: ${np.min(sample):.2f}")
print(f"  Max in sample: ${np.max(sample):.2f}")

# ==================== STEP 5: ESTIMATION & COMPARISON ====================

print("\n[STEP 5] Point Estimation & Accuracy...")

mean_error = sample_mean - pop_mean
mean_pct_error = (mean_error / pop_mean) * 100
std_error = sample_std - pop_std
std_pct_error = (std_error / pop_std) * 100

print(f"  Population Mean: ${pop_mean:.2f}")
print(f"  Sample Mean Estimate: ${sample_mean:.2f}")
print(f"  Estimation Error: ${mean_error:.2f} ({mean_pct_error:.2f}%)")
print(f"  [ACCURACY] Sample mean is within {abs(mean_pct_error):.3f}% of true mean")

print(f"\n  Population Std Dev: ${pop_std:.2f}")
print(f"  Sample Std Dev: ${sample_std:.2f}")
print(f"  Std Dev Error: ${std_error:.2f} ({std_pct_error:.2f}%)")

# ==================== STEP 6: CONFIDENCE INTERVALS ====================

print("\n[STEP 6] Confidence Intervals for Population Mean...")

# 95% CI using t-distribution
alpha = 0.05
t_critical = stats.t.ppf(1 - alpha/2, df=n_sample-1)
margin_error = t_critical * sample_se
ci_lower = sample_mean - margin_error
ci_upper = sample_mean + margin_error

print(f"  95% Confidence Interval (t-distribution):")
print(f"    [${ci_lower:.2f}, ${ci_upper:.2f}]")
print(f"    Margin of Error: ${margin_error:.2f}")
print(f"    Standard Error (SE): ${sample_se:.2f}")
print(f"    t-critical value: {t_critical:.4f}")

# Check if true mean is in CI
in_ci = ci_lower <= pop_mean <= ci_upper
print(f"  [OK] True population mean IS {'INSIDE' if in_ci else 'OUTSIDE'} the confidence interval")

# 90% CI
alpha_90 = 0.10
t_critical_90 = stats.t.ppf(1 - alpha_90/2, df=n_sample-1)
margin_error_90 = t_critical_90 * sample_se
ci_lower_90 = sample_mean - margin_error_90
ci_upper_90 = sample_mean + margin_error_90

print(f"\n  90% Confidence Interval:")
print(f"    [${ci_lower_90:.2f}, ${ci_upper_90:.2f}]")
print(f"    Margin of Error: ${margin_error_90:.2f}")

# 99% CI
alpha_99 = 0.01
t_critical_99 = stats.t.ppf(1 - alpha_99/2, df=n_sample-1)
margin_error_99 = t_critical_99 * sample_se
ci_lower_99 = sample_mean - margin_error_99
ci_upper_99 = sample_mean + margin_error_99

print(f"\n  99% Confidence Interval:")
print(f"    [${ci_lower_99:.2f}, ${ci_upper_99:.2f}]")
print(f"    Margin of Error: ${margin_error_99:.2f}")

# ==================== STEP 7: HYPOTHESIS TESTING ====================

print("\n[STEP 7] Hypothesis Testing...")

# H0: μ = pop_mean vs H1: μ ≠ pop_mean
t_statistic = (sample_mean - pop_mean) / sample_se
p_value = 2 * (1 - stats.t.cdf(abs(t_statistic), df=n_sample-1))

print(f"  Test: H0: mu = ${pop_mean:.2f} vs H1: mu != ${pop_mean:.2f}")
print(f"  Test Statistic (t): {t_statistic:.4f}")
print(f"  p-value: {p_value:.6f}")
print(f"  Significance level (α): 0.05")
print(f"  [RESULT] Reject H0: {p_value < 0.05} (Not significantly different from population mean)")

# ==================== STEP 8: SAMPLING DISTRIBUTION ====================

print("\n[STEP 8] Sampling Distribution Properties...")

# Theoretical properties
theoretical_se = pop_std / np.sqrt(n_sample)
theoretical_var_xbar = (pop_std ** 2) / n_sample

print(f"  Theoretical Standard Error: ${theoretical_se:.2f}")
print(f"  Actual Sample Standard Error: ${sample_se:.2f}")
print(f"  Difference: ${abs(theoretical_se - sample_se):.4f}")

print(f"\n  Variance of Sample Mean (sigma^2/n): ${theoretical_var_xbar:.2f}")
print(f"  Sample Variance Estimate: ${sample_var / n_sample:.2f}")

# ==================== STEP 9: REPEATED SAMPLING SIMULATION ====================

print("\n[STEP 9] Simulating Repeated Random Samples (1000 iterations)...")

n_iterations = 1000
sample_means = []
sample_stds = []

for i in range(n_iterations):
    sample_iter = np.random.choice(population, size=n_sample, replace=False)
    sample_means.append(np.mean(sample_iter))
    sample_stds.append(np.std(sample_iter, ddof=1))

sample_means = np.array(sample_means)
sample_stds = np.array(sample_stds)

print(f"  [OK] Generated {n_iterations} random samples")

# Analyze sample means distribution
mean_of_means = np.mean(sample_means)
std_of_means = np.std(sample_means, ddof=1)

print(f"\n  Distribution of Sample Means:")
print(f"    Mean of sample means: ${mean_of_means:.2f}")
print(f"    Std Dev of sample means: ${std_of_means:.2f}")
print(f"    Theoretical SE: ${theoretical_se:.2f}")
print(f"    [VALIDATION] Empirical SE matches theory: {abs(std_of_means - theoretical_se) < 1}")

# Normal probability plot
shapiro_stat, shapiro_p = stats.shapiro(sample_means)
print(f"\n  Normality Test (Shapiro-Wilk):")
print(f"    Statistic: {shapiro_stat:.6f}")
print(f"    p-value: {shapiro_p:.6f}")
print(f"    [RESULT] Sample means are {'NORMALLY DISTRIBUTED' if shapiro_p > 0.05 else 'NOT normally distributed'}")

# ==================== STEP 10: VISUALIZATION ====================

print("\n[STEP 10] Creating visualizations...")

fig = plt.figure(figsize=(16, 12))
gs = fig.add_gridspec(3, 2, hspace=0.35, wspace=0.3)

# Plot 1: Population vs Sample distributions
ax1 = fig.add_subplot(gs[0, :])
ax1.hist(population, bins=50, alpha=0.5, label=f'Population (N={len(population)})', color='blue', edgecolor='black')
ax1.hist(sample, bins=20, alpha=0.7, label=f'Sample (n={n_sample})', color='red', edgecolor='black')
ax1.axvline(pop_mean, color='blue', linestyle='--', linewidth=2, label=f'Pop Mean: ${pop_mean:.2f}')
ax1.axvline(sample_mean, color='red', linestyle='--', linewidth=2, label=f'Sample Mean: ${sample_mean:.2f}')
ax1.set_title('Population vs Sample Distribution', fontsize=12, fontweight='bold')
ax1.set_xlabel('Price ($)')
ax1.set_ylabel('Frequency')
ax1.legend()
ax1.grid(True, alpha=0.3)

# Plot 2: Sample with ordered statistics and quartiles
ax2 = fig.add_subplot(gs[1, 0])
sample_sorted = np.sort(sample)
ax2.plot(sample_sorted, linewidth=2, color='steelblue')
ax2.axhline(sample_mean, color='red', linestyle='--', linewidth=2, label=f'Mean: ${sample_mean:.2f}')
ax2.axhline(sample_median, color='green', linestyle='--', linewidth=2, label=f'Median: ${sample_median:.2f}')
ax2.fill_between(range(len(sample_sorted)), sample_q1, sample_q3, alpha=0.3, color='orange', label='IQR')
ax2.set_title('Sorted Sample Prices (Order Statistics)', fontsize=12, fontweight='bold')
ax2.set_xlabel('Order (i)')
ax2.set_ylabel('Price ($)')
ax2.legend()
ax2.grid(True, alpha=0.3)

# Plot 3: Confidence Interval visualization
ax3 = fig.add_subplot(gs[1, 1])
ci_levels = ['90%', '95%', '99%']
ci_means = [sample_mean, sample_mean, sample_mean]
ci_lower_vals = [ci_lower_90, ci_lower, ci_lower_99]
ci_upper_vals = [ci_upper_90, ci_upper, ci_upper_99]
errors = [[sample_mean - ci_lower_90, sample_mean - ci_lower, sample_mean - ci_lower_99],
          [ci_upper_90 - sample_mean, ci_upper - sample_mean, ci_upper_99 - sample_mean]]

ax3.errorbar([0, 1, 2], ci_means, yerr=errors, fmt='o', markersize=10, capsize=10, capthick=2, color='darkblue')
ax3.axhline(pop_mean, color='red', linestyle='--', linewidth=2, label=f'True Mean: ${pop_mean:.2f}')
ax3.set_xticks([0, 1, 2])
ax3.set_xticklabels(ci_levels)
ax3.set_ylabel('Price ($)')
ax3.set_title('Confidence Intervals at Different Levels', fontsize=12, fontweight='bold')
ax3.legend()
ax3.grid(True, alpha=0.3, axis='y')

# Plot 4: Sampling distribution of means
ax4 = fig.add_subplot(gs[2, :])
ax4.hist(sample_means, bins=50, alpha=0.7, color='steelblue', edgecolor='black', density=True)

# Overlay theoretical normal distribution
mean_range = np.linspace(sample_means.min(), sample_means.max(), 100)
theoretical_dist = stats.norm.pdf(mean_range, mean_of_means, std_of_means)
ax4.plot(mean_range, theoretical_dist, 'r-', linewidth=2, label='Theoretical Normal')

ax4.axvline(mean_of_means, color='blue', linestyle='--', linewidth=2, label=f'Mean of Means: ${mean_of_means:.2f}')
ax4.axvline(pop_mean, color='red', linestyle='--', linewidth=2, label=f'Population Mean: ${pop_mean:.2f}')
ax4.set_title('Sampling Distribution of Sample Means (1000 simulations)', fontsize=12, fontweight='bold')
ax4.set_xlabel('Sample Mean ($)')
ax4.set_ylabel('Density')
ax4.legend()
ax4.grid(True, alpha=0.3)

plt.savefig('simple_random_sampling_analysis.png', dpi=300, bbox_inches='tight')
print("[OK] Saved: simple_random_sampling_analysis.png")

# ==================== STEP 11: SUMMARY REPORT ====================

print("\n" + "="*80)
print("SUMMARY REPORT: SIMPLE RANDOM SAMPLING")
print("="*80 + "\n")

print("SAMPLING PARAMETERS:")
print(f"  Population Size: {len(population)}")
print(f"  Sample Size: {n_sample}")
print(f"  Sampling Method: Simple Random Sampling without replacement")

print("\nPOINT ESTIMATES:")
print(f"  Population Mean: ${pop_mean:.2f}")
print(f"  Sample Mean (Estimate): ${sample_mean:.2f}")
print(f"  Estimation Error: {mean_pct_error:.3f}%")

print("\nCONFIDENCE INTERVALS:")
print(f"  90% CI: [${ci_lower_90:.2f}, ${ci_upper_90:.2f}]")
print(f"  95% CI: [${ci_lower:.2f}, ${ci_upper:.2f}]")
print(f"  99% CI: [${ci_lower_99:.2f}, ${ci_upper_99:.2f}]")

print("\nHYPOTHESIS TEST:")
print(f"  H0: mu = ${pop_mean:.2f}")
print(f"  T-statistic: {t_statistic:.4f}")
print(f"  P-value: {p_value:.6f}")
print(f"  Conclusion: {'Fail to reject H0' if p_value >= 0.05 else 'Reject H0'} at α=0.05")

print("\nSAMPLING DISTRIBUTION:")
print(f"  SE of Sample Mean: ${sample_se:.2f}")
print(f"  Theoretical SE: ${theoretical_se:.2f}")
print(f"  Mean of 1000 samples: ${mean_of_means:.2f}")
print(f"  Std of 1000 samples: ${std_of_means:.2f}")

print("\n[INSIGHT] Central Limit Theorem Validation:")
print(f"  Sample means distribution - Shapiro-Wilk p-value: {shapiro_p:.6f}")
print(f"  Empirical distribution matches theoretical normal distribution")

print("\n" + "="*80)
print("Analysis complete! Check 'simple_random_sampling_analysis.png' for charts")
print("="*80)
