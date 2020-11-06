<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settingformulir".
 *
 * @property string $KodeLokasi
 * @property int $JenisTransaksi StokOpname 0, Distribusi 1, Pembelian 2, ReturPembelian 3, PembayaranHutangTunai 4, PembayaranHutangBank 5, Penjualan 6, ReturPenjualan 7, PenerimaanPiutangTunai 8, PenerimaanPiutangBank 9, PerubahanHargaJual 10, Verifikasi 11
 * @property string $Inisial
 * @property int $LebarNoTransaksi
 * @property int $PostingBilling
 * @property string $KodeUnitPelayanan
 * @property string $KodeRuangPelayanan
 * @property int $JasaFarmasiRI
 * @property int $JasaFarmasiRJ
 * @property int $JasaFarmasiIRD
 * @property int $JasaFarmasiTempo
 * @property int $JasaFarmasiUmum
 * @property string $NilaiJasaRI
 * @property string $NIlaiJasaRJ
 * @property string $NilaiJasaIRD
 * @property string $NilaiJasaTempo
 * @property string $NilaiJasaUmum
 * @property int $NomerTerakhir
 */
class SettingFormulir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settingformulir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['JenisTransaksi', 'LebarNoTransaksi', 'PostingBilling', 'JasaFarmasiRI', 'JasaFarmasiRJ', 'JasaFarmasiIRD', 'JasaFarmasiTempo', 'JasaFarmasiUmum', 'NomerTerakhir'], 'integer'],
            [['NilaiJasaRI', 'NIlaiJasaRJ', 'NilaiJasaIRD', 'NilaiJasaTempo', 'NilaiJasaUmum'], 'number'],
            [['NomerTerakhir'], 'required'],
            [['KodeLokasi', 'Inisial'], 'string', 'max' => 5],
            [['KodeUnitPelayanan', 'KodeRuangPelayanan'], 'string', 'max' => 6],
            [['KodeLokasi', 'JenisTransaksi'], 'unique', 'targetAttribute' => ['KodeLokasi', 'JenisTransaksi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
             'id' => 'ID',
            'KodeLokasi' => Yii::t('app', 'Kode Lokasi'),
            'JenisTransaksi' => Yii::t('app', 'Jenis Transaksi'),
            'Inisial' => Yii::t('app', 'Inisial'),
            'LebarNoTransaksi' => Yii::t('app', 'Lebar No Transaksi'),
            'PostingBilling' => Yii::t('app', 'Posting Billing'),
            'KodeUnitPelayanan' => Yii::t('app', 'Kode Unit Pelayanan'),
            'KodeRuangPelayanan' => Yii::t('app', 'Kode Ruang Pelayanan'),
            'JasaFarmasiRI' => Yii::t('app', 'Jasa Farmasi Ri'),
            'JasaFarmasiRJ' => Yii::t('app', 'Jasa Farmasi Rj'),
            'JasaFarmasiIRD' => Yii::t('app', 'Jasa Farmasi Ird'),
            'JasaFarmasiTempo' => Yii::t('app', 'Jasa Farmasi Tempo'),
            'JasaFarmasiUmum' => Yii::t('app', 'Jasa Farmasi Umum'),
            'NilaiJasaRI' => Yii::t('app', 'Nilai Jasa Ri'),
            'NIlaiJasaRJ' => Yii::t('app', 'N Ilai Jasa Rj'),
            'NilaiJasaIRD' => Yii::t('app', 'Nilai Jasa Ird'),
            'NilaiJasaTempo' => Yii::t('app', 'Nilai Jasa Tempo'),
            'NilaiJasaUmum' => Yii::t('app', 'Nilai Jasa Umum'),
            'NomerTerakhir' => Yii::t('app', 'Nomer Terakhir'),
        ];
    }
}
