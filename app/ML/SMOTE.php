<?php

namespace App\ML;

class SMOTE
{
    private $k;

    public function __construct($k = 5)
    {
        $this->k = $k;
    }

    /**
     * Resample the dataset to balance the classes.
     * Assumes binary classification with classes 0 (majority) and 1 (minority).
     *
     * @param array $X Features
     * @param array $y Labels
     * @return array [$X_resampled, $y_resampled]
     */
    public function fitResample($X, $y)
    {
        $numSamples = count($X);
        if ($numSamples === 0) {
            return [$X, $y];
        }

        // Separate majority (0) and minority (1) samples
        $majorityX = [];
        $minorityX = [];

        for ($i = 0; $i < $numSamples; $i++) {
            if ($y[$i] == 1) {
                $minorityX[] = $X[$i];
            } else {
                $majorityX[] = $X[$i];
            }
        }

        $numMaj = count($majorityX);
        $numMin = count($minorityX);

        // If either class is empty, or classes are already balanced/minority is larger, return original
        if ($numMin === 0 || $numMaj === 0 || $numMin >= $numMaj) {
            return [$X, $y];
        }

        $syntheticX = [];
        $syntheticY = [];

        // If there's only 1 minority sample, we cannot find neighbors. Just duplicate it.
        if ($numMin === 1) {
            $singleMin = $minorityX[0];
            $diff = $numMaj - $numMin;
            for ($i = 0; $i < $diff; $i++) {
                $syntheticX[] = $singleMin;
                $syntheticY[] = 1;
            }
        } else {
            // Determine actual k
            $actualK = min($this->k, $numMin - 1);
            $diff = $numMaj - $numMin;

            for ($i = 0; $i < $diff; $i++) {
                // Pick a random minority sample index
                $idx = rand(0, $numMin - 1);
                $originSample = $minorityX[$idx];

                // Find k-nearest neighbors among minority samples
                $neighbors = $this->getKNearestNeighbors($originSample, $minorityX, $idx, $actualK);

                // Pick one neighbor randomly
                $neighborSample = $neighbors[rand(0, count($neighbors) - 1)];

                // Create synthetic sample
                $syntheticSample = [];
                $numFeatures = count($originSample);
                $gap = rand(0, 1000) / 1000.0; // random float between 0 and 1

                for ($j = 0; $j < $numFeatures; $j++) {
                    $syntheticSample[] = $originSample[$j] + $gap * ($neighborSample[$j] - $originSample[$j]);
                }

                $syntheticX[] = $syntheticSample;
                $syntheticY[] = 1;
            }
        }

        // Combine all samples
        $X_resampled = array_merge($majorityX, $minorityX, $syntheticX);
        $y_resampled = array_merge(
            array_fill(0, $numMaj, 0),
            array_fill(0, $numMin, 1),
            $syntheticY
        );

        // Shuffle the resampled dataset
        $indices = range(0, count($X_resampled) - 1);
        shuffle($indices);

        $X_shuffled = [];
        $y_shuffled = [];
        foreach ($indices as $idx) {
            $X_shuffled[] = $X_resampled[$idx];
            $y_shuffled[] = $y_resampled[$idx];
        }

        return [$X_shuffled, $y_shuffled];
    }

    /**
     * Find the k nearest neighbors for a sample in a dataset, excluding the sample itself.
     */
    private function getKNearestNeighbors($sample, $dataset, $sampleIdx, $k)
    {
        $distances = [];
        foreach ($dataset as $idx => $data) {
            if ($idx === $sampleIdx) continue;
            
            $dist = $this->euclideanDistance($sample, $data);
            $distances[] = [
                'index' => $idx,
                'distance' => $dist,
                'data' => $data
            ];
        }

        // Sort by distance ascending
        usort($distances, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        // Take top k
        $neighbors = [];
        for ($i = 0; $i < $k; $i++) {
            if (isset($distances[$i])) {
                $neighbors[] = $distances[$i]['data'];
            }
        }

        return $neighbors;
    }

    /**
     * Compute Euclidean distance between two vectors.
     */
    private function euclideanDistance($x1, $x2)
    {
        $sum = 0.0;
        $len = count($x1);
        for ($i = 0; $i < $len; $i++) {
            $sum += pow($x1[$i] - $x2[$i], 2);
        }
        return sqrt($sum);
    }
}
