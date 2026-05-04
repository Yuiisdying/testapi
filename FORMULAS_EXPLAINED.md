# Statistical Formulas - Mathematical Explanation

All the mathematical formulas used in the sampling analysis, explained clearly.

---

## 1️⃣ BASIC STATISTICS

### Population Mean (μ)
$$\mu = \frac{\sum_{i=1}^{N} x_i}{N}$$

**What it means:** Add all prices, divide by total count
- N = 1,347 total prices
- Sum all prices, divide by 1,347
- Result: Average price = **$1,930**

**Example:**
If prices are: $1900, $1920, $1950
$$\mu = \frac{1900 + 1920 + 1950}{3} = \frac{5770}{3} = \$1923.33$$

---

### Population Standard Deviation (σ)
$$\sigma = \sqrt{\frac{\sum_{i=1}^{N} (x_i - \mu)^2}{N}}$$

**What it means:** Measure how spread out prices are from the average

**Steps:**
1. Find difference from mean: $(x_i - \mu)$
2. Square each difference: $(x_i - \mu)^2$
3. Average all squared differences
4. Take square root

**Example:**
Prices: $1900, $1920, $1950; Mean = $1923.33

| Price | Difference | Squared |
|-------|-----------|---------|
| $1900 | -23.33 | 544.29 |
| $1920 | -3.33 | 11.11 |
| $1950 | 26.67 | 711.11 |

$$\sigma = \sqrt{\frac{544.29 + 11.11 + 711.11}{3}} = \sqrt{\frac{1266.51}{3}} = \sqrt{422.17} = \$20.55$$

---

### Sample Standard Deviation (s)
$$s = \sqrt{\frac{\sum_{i=1}^{n} (x_i - \bar{x})^2}{n-1}}$$

**What it means:** Same as population σ, but divide by **(n-1)** instead of n

**Why n-1?** Because we're *estimating* from a sample, not measuring the whole population

**Example:** With sample of 100 prices
$$s = \sqrt{\frac{\text{sum of squared differences}}{100-1}} = \sqrt{\frac{\text{sum}}{99}}$$

---

### Sample Mean (x̄)
$$\bar{x} = \frac{\sum_{i=1}^{n} x_i}{n}$$

**What it means:** Average of just the 100 sample prices (not all 1,347)

---

## 2️⃣ STANDARD ERROR (The "Big E" Formula!)

### Standard Error Formula
$$SE = \frac{s}{\sqrt{n}}$$

**What it means:** How much uncertainty in your sample mean

**Components:**
- $s$ = how spread out the sample is
- $n$ = sample size (100)
- $\sqrt{n}$ = square root of sample size

**Example:**
If sample standard deviation = $280 and n = 100:
$$SE = \frac{280}{\sqrt{100}} = \frac{280}{10} = \$28$$

This means: **The true mean is probably within ±$28 of what we calculated**

---

### Why Divide by √n?

**Bigger sample = smaller uncertainty:**

| If n = | √n | SE = 280/√n |
|-------|----|----|
| 100 | 10 | $28 |
| 400 | 20 | $14 |
| 900 | 30 | $9.33 |
| 10,000 | 100 | $2.80 |

**Double the sample size → Cut uncertainty in half!**

---

## 3️⃣ CONFIDENCE INTERVALS

### 95% Confidence Interval
$$CI = \bar{x} \pm 1.96 \times SE$$

**What it means:** 95% chance the true mean is in this range

**Example:**
If $\bar{x} = \$1932$ and $SE = \$28$:
$$CI = 1932 \pm (1.96 \times 28)$$
$$CI = 1932 \pm 54.88$$
$$CI = [\$1877.12, \$1986.88]$$

**Interpretation:** "We're 95% confident the true average gold price is between $1,877 and $1,987"

---

## 4️⃣ ESTIMATION ERROR

### Absolute Error
$$Error = |\bar{x} - \mu|$$

**What it means:** How far the sample mean is from the true population mean

**Example:**
- True mean: $\mu = \$1,930$
- Sample mean: $\bar{x} = \$1,932$
- Error = $|1932 - 1930| = \$2$

---

### Percentage Error
$$Error\% = \frac{|\bar{x} - \mu|}{\mu} \times 100\%$$

**Example:**
$$Error\% = \frac{|1932 - 1930|}{1930} \times 100\% = \frac{2}{1930} \times 100\% = 0.104\%$$

**Interpretation:** "Our estimate is 0.104% off from reality"

---

## 5️⃣ SAMPLING EFFICIENCY

### Relative Efficiency
$$E = \left(\frac{\sigma}{SE}\right)^2$$

**What it means:** How much information you get per sample compared to population variation

**Components:**
- $\sigma$ = population standard deviation (how much variation exists)
- $SE$ = standard error of your method (how uncertain your estimate is)

**Example:**
If population SD = $285 and SE = $28:
$$E = \left(\frac{285}{28}\right)^2 = (10.18)^2 = 103.6x$$

**Interpretation:** "This method gives you 103.6 times more statistical power than the population variation alone"

---

## 6️⃣ STRATIFIED SAMPLING MATH

### Proportional Allocation
$$n_h = n \times \frac{N_h}{N}$$

**What it means:** How many samples to take from each stratum (group)

**Components:**
- $n_h$ = samples from stratum h
- $n$ = total sample size (100)
- $N_h$ = size of stratum h
- $N$ = total population size (1,347)

**Example:**
If we have 5 price strata:
- Stratum 1 (Low): 200 prices
- Stratum 2: 300 prices
- Stratum 3 (Mid): 350 prices
- Stratum 4: 300 prices
- Stratum 5 (High): 197 prices

For Stratum 2 (n=100 total):
$$n_2 = 100 \times \frac{300}{1347} = 100 \times 0.2227 = 22.27 \approx 22 \text{ samples}$$

**So:** Take 22 prices from Stratum 2 to represent it fairly

---

### Stratified Sample Mean
$$\bar{x}_{st} = \sum_{h=1}^{L} \frac{N_h}{N} \bar{x}_h$$

**What it means:** Weight each stratum's mean by its proportion of the population

**Components:**
- $L$ = number of strata (5)
- $\bar{x}_h$ = mean of stratum h
- $\frac{N_h}{N}$ = proportion of stratum h

**Example:**
If stratum means are:
- $\bar{x}_1 = \$1,800$ (proportion: 14.8%)
- $\bar{x}_2 = \$1,900$ (proportion: 22.3%)
- $\bar{x}_3 = \$1,950$ (proportion: 26.0%)
- $\bar{x}_4 = \$1,950$ (proportion: 22.3%)
- $\bar{x}_5 = \$2,050$ (proportion: 14.6%)

$$\bar{x}_{st} = (0.148 \times 1800) + (0.223 \times 1900) + (0.260 \times 1950) + (0.223 \times 1950) + (0.146 \times 2050)$$
$$= 266.4 + 423.7 + 507 + 434.85 + 299.3 = \$1,931.25$$

---

### Stratified Standard Error
$$SE_{st} = \sqrt{\sum_{h=1}^{L} \left(\frac{N_h}{N}\right)^2 \frac{s_h^2}{n_h}}$$

**What it means:** Standard error when using stratified sampling

**Components:**
- $s_h^2$ = variance within stratum h
- $n_h$ = sample size from stratum h
- More complex because each stratum contributes differently

---

## 7️⃣ SYSTEMATIC SAMPLING MATH

### Sampling Interval
$$k = \frac{N}{n}$$

**What it means:** Pick every k-th element

**Example:**
If N = 1,347 and n = 100:
$$k = \frac{1347}{100} = 13.47 \approx 13$$

**So:** Pick every 13th price from the sorted list

---

### Systematic Sample
$$x_i = x_{r + (i-1)k}$$

Where:
- $r$ = random starting point (0 to k)
- $i$ = sample number (1 to n)

**Example:**
If $r = 5$ and $k = 13$:
- 1st sample: position 5
- 2nd sample: position 5 + 13 = 18
- 3rd sample: position 5 + 26 = 31
- ...
- 100th sample: position 5 + 1,287 = 1,292

---

## 8️⃣ CLUSTER SAMPLING MATH

### Number of Clusters to Select
$$m = \text{randomly choose } m \text{ clusters from } M \text{ total clusters}$$

**Example:**
If M = 10 total clusters, randomly select m = 3:
- Select Clusters: 2, 5, 7

---

### Cluster Sample Mean
$$\bar{x}_{cl} = \frac{\sum_{j \in \text{selected}} \sum_{i \in j} x_{ij}}{n}$$

**What it means:** Average of all prices in selected clusters

**Example:**
If selecting clusters with sizes and means:
- Cluster 2: 140 prices, mean = $1,920
- Cluster 5: 138 prices, mean = $1,940
- Cluster 7: 135 prices, mean = $1,905

Total n = 140 + 138 + 135 = 413 prices
$$\bar{x}_{cl} = \frac{(140 \times 1920) + (138 \times 1940) + (135 \times 1905)}{413}$$
$$= \frac{268800 + 267720 + 257175}{413} = \frac{793695}{413} = \$1,922.20$$

---

## 9️⃣ ERROR COMPARISONS

### Mean Square Error (MSE)
$$MSE = E[(\bar{x} - \mu)^2]$$

**What it means:** Average squared distance from true mean (measures accuracy)

**Lower = Better**

---

### Coefficient of Variation
$$CV = \frac{s}{\bar{x}} \times 100\%$$

**What it means:** Standard deviation as percentage of mean

**Example:**
If $s = 280$ and $\bar{x} = 1932$:
$$CV = \frac{280}{1932} \times 100\% = 14.49\%$$

**Interpretation:** "The variation is 14.49% of the mean"

---

## 🔟 HYPOTHESIS TEST - t-statistic

### t-test for Sample Mean
$$t = \frac{\bar{x} - \mu_0}{SE} = \frac{\bar{x} - \mu_0}{s / \sqrt{n}}$$

**What it means:** Does the sample mean significantly differ from expected value?

**Components:**
- $\bar{x}$ = sample mean
- $\mu_0$ = hypothesized population mean
- $SE$ = standard error

**Example:**
If $\bar{x} = 1932$, $\mu_0 = 1930$, $SE = 28$:
$$t = \frac{1932 - 1930}{28} = \frac{2}{28} = 0.071$$

**Interpretation:** "The difference is very small (0.071 standard errors), not statistically significant"

---

## Summary Table

| Formula | Symbol | Meaning | Result |
|---------|--------|---------|--------|
| $\mu = \frac{\sum x}{N}$ | μ | Population mean | $1,930 |
| $\sigma = \sqrt{\frac{\sum(x-\mu)^2}{N}}$ | σ | Population spread | $285 |
| $\bar{x} = \frac{\sum x}{n}$ | x̄ | Sample mean | $1,932 |
| $s = \sqrt{\frac{\sum(x-\bar{x})^2}{n-1}}$ | s | Sample spread | $280 |
| $SE = \frac{s}{\sqrt{n}}$ | SE | Uncertainty | $28 |
| $E = (\sigma/SE)^2$ | E | Efficiency | 103.6x |
| $\bar{x} \pm 1.96 \times SE$ | CI | 95% confidence range | [$1,877, $1,987] |

---

## Key Insights

1. **√n matters most** - Doubling samples halves uncertainty
2. **Stratification reduces SE** - Using strata information improves precision  
3. **Efficiency = (Population Variation) / (Sample Uncertainty)** - Higher is better
4. **Bigger error % means less reliable** - Want <1% for critical decisions
5. **Standard Error lets you build confidence intervals** - Know your uncertainty range

