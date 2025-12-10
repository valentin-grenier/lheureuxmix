import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import { Panel, PanelBody, PanelRow } from '@wordpress/components';
import { ToggleControl, TextControl, Button, Spinner } from '@wordpress/components';

import { useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { useEffect } from '@wordpress/element';

import { useDispatch, useSelect } from '@wordpress/data';
import { store as noticesStore } from '@wordpress/notices';
import { NoticeList } from '@wordpress/components';

import './index.scss';

const useSettings = () => {
	const [isLoading, setIsLoading] = useState(true);
	const [show, setShow] = useState(false);
	const [title, setTitle] = useState('');
	const [hours, setHours] = useState('');
	const [tel, setTel] = useState('');
	const [isSaving, setIsSaving] = useState(false);

	const { createSuccessNotice, removeAllNotices } = useDispatch(noticesStore);

	useEffect(() => {
		apiFetch({ path: '/wp/v2/settings' })
			.then((settings) => {
				const mySettings = settings.heureux_mix_utils;
				if (mySettings) {
					setShow(mySettings.show);
					setTitle(mySettings.title);
					setHours(mySettings.hours);
					setTel(mySettings.tel);

					setIsLoading(false);
				}
			})
			.catch((error) => {
				console.error('Error fetching settings:', error);
				setIsLoading(false);
			});
	}, []);

	const saveSettings = () => {
		apiFetch({
			path: '/wp/v2/settings',
			method: 'POST',
			data: {
				heureux_mix_utils: { show, title, hours, tel },
			},
		})
			.then(() => {
				// == Remove existing notices
				removeAllNotices();
				setIsSaving(true);

				setTimeout(() => {
					createSuccessNotice(__('Settings saved.', 'heureux-mix'));
					setIsSaving(false);
				}, 500);
			})
			.catch((error) => {
				console.error('Error saving settings:', error);
			});
	};

	return { show, setShow, title, setTitle, hours, setHours, tel, setTel, saveSettings, isLoading, isSaving };
};

const ShowControl = ({ value, onChange }) => {
	return <ToggleControl label={__('Afficher sur le site', 'heureux-mix')} checked={value} onChange={onChange} __nextHasNoMarginBottom />;
};

const TitleControl = ({ value, onChange }) => {
	return <TextControl label={__('Titre', 'heureux-mix')} value={value} onChange={onChange} />;
};

const HoursControl = ({ value, onChange }) => {
	return <TextControl label={__('Horaires', 'heureux-mix')} value={value} onChange={onChange} />;
};

const TelControl = ({ value, onChange }) => {
	return <TextControl label={__('Téléphone', 'heureux-mix')} help={__("Pas d'espaces. Ex : 0612345678", 'heureux-mix')} type="number" value={value} onChange={onChange} />;
};

const SaveButton = ({ onClick }) => {
	return (
		<Button isPrimary onClick={onClick}>
			{__('Enregistrer', 'heureux-mix')}
		</Button>
	);
};

const Notices = () => {
	const { removeNotices } = useDispatch(noticesStore);
	const notices = useSelect((select) => select(noticesStore).getNotices());

	if (notices.length === 0) {
		return null;
	}

	return <NoticeList notices={notices} onRemove={removeNotices} />;
};

const SettingsPage = () => {
	const { show, setShow, title, setTitle, hours, setHours, tel, setTel, saveSettings, isLoading, isSaving } = useSettings();

	if (isLoading) {
		return <p>{__('Loading...', 'heureux-mix')}</p>;
	} else {
		return (
			<>
				<h1>{__('Heureux Mix Utils', 'heureux-mix')}</h1>
				<Panel header={'Popup "Infoline DJ"'}>
					<PanelBody>
						<PanelRow>
							<ShowControl value={show} onChange={setShow} />
						</PanelRow>
					</PanelBody>
					{show && (
						<PanelBody title={__('Informations', 'heureux-mix')} initialOpen={true}>
							<PanelRow>
								<TitleControl value={title} onChange={setTitle} />
							</PanelRow>
							<PanelRow>
								<HoursControl value={hours} onChange={setHours} />
							</PanelRow>
							<PanelRow>
								<TelControl value={tel} onChange={setTel} />
							</PanelRow>
						</PanelBody>
					)}
				</Panel>
				{isSaving ? <Spinner /> : <SaveButton onClick={saveSettings} />}

				<Notices />
			</>
		);
	}
};

domReady(() => {
	const root = createRoot(document.getElementById('heureux-mix-utils'));

	root.render(<SettingsPage />);
});
